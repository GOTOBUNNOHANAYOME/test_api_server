<?php

namespace App\Http\Controllers;

use App\Enums\QuantsMethodStatus;
use App\Models\{
    BalanceSheet,
    CashFlowStatement,
    Company,
    Document,
    ProfitAndLossStatement
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\{
    Client,
    Pool,
    Psr7\Request as GuzzleRequest
};

class DocumentController extends Controller
{
    protected $last_document_id;

    public function __construct() {
        $this->last_document_id = (int)Document::orderBy('id', 'DESC')?->first()?->id ?? 0;
    }
    public function create(Request $request)
    {
        return view('document.create');
    }

    public function store(Request $request)
    {
        $quants_method = auth()->user()
        ?->quantsMethods()
        ?->where('status', QuantsMethodStatus::COMPLETED)
        ?->first();


        $headers = [
            'Authorization' => 'Bearer ' . $quants_method->id_token,
        ];
        $client = new Client();

        $balance_sheet_params = [];
        $cash_flow_statement_params = [];
        $profit_and_loss_statement_params = [];
        $document_params = [];

        $companies = Company::query()
        ->when(!is_null($request->code), function($query) use ($request) {
            return $query->where('code', $request->code)
                ->orWhere('name', 'LIKE', '%'.$request->code.'%');
        })
        ->get();

        $requests = function ($companies) use ($client, $headers) {
            foreach ($companies as $company) {
                if (is_null($company->code)) {
                    continue;
                }
                yield new GuzzleRequest('GET', config('jquants.statements'), [
                    'headers' => $headers,
                    'query' => [
                        'code' => $company->code
                    ]
                ]);
            }
        };

        $pool = new Pool($client, $requests($companies), [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) use (&$companies, &$document_params,
                &$balance_sheet_params, &$cash_flow_statement_params, &$profit_and_loss_statement_params) {

                $company = $companies[$index];
                $response_params = json_decode($response->getBody()->getContents());
                $now = now();
                foreach ($response_params->statements as $response_param) {
                    $this->last_document_id++;

                    $document_params[] = [
                        'id'            => $this->last_document_id,
                        'company_id'    => $company->id,
                        'type'          => $response_param->TypeOfCurrentPeriod,
                        'start_date'    => $response_param->CurrentPeriodStartDate,
                        'end_date'      => $response_param->CurrentPeriodEndDate,
                        'created_at'    => $now,
                        'updated_at'    => $now
                    ];

                    $balance_sheet_params[] = [
                        'document_id' => $this->last_document_id,
                        'assets'      => (int)$response_param->TotalAssets,
                        'equity'      => (int)$response_param->Equity,
                        'liabilities' => (int)$response_param->TotalAssets - (int)$response_param->Equity,
                        'created_at'  => $now,
                        'updated_at'  => $now
                    ];
                    
                    $profit_and_loss_statement_params[] = [
                        'document_id'       => $this->last_document_id,
                        'net_sales'         => (int)$response_param->NetSales,
                        'operating_profit'  => (int)$response_param->OperatingProfit,
                        'ordinary_profit'   => (int)$response_param->OrdinaryProfit,
                        'profit'            => (int)$response_param->Profit,
                        'created_at'        => $now,
                        'updated_at'        => $now
                    ];

                    $cash_flow_statement_params[] = [
                        'document_id' => $this->last_document_id,
                        'operating'   => (int)$response_param->CashFlowsFromOperatingActivities,
                        'investing'   => (int)$response_param->CashFlowsFromInvestingActivities,
                        'financing'   => (int)$response_param->CashFlowsFromFinancingActivities,
                        'cash'        => (int)$response_param->CashAndEquivalents,
                        'created_at'  => $now,
                        'updated_at'  => $now
                    ];
                }
            },
            'rejected' => function ($reason, $index) {
            }
        ]);

        $promise = $pool->promise();
        $promise->wait();

        try {
            DB::beginTransaction();
            Document::insert($document_params);
            BalanceSheet::insert($balance_sheet_params);
            ProfitAndLossStatement::insert($profit_and_loss_statement_params);
            CashFlowStatement::insert($cash_flow_statement_params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('document.create');
    }
}
