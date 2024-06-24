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
use GuzzleHttp\Client;

class DocumentController extends Controller
{
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
        $last_document_id = (int)Document::orderBy('id', 'DESC')?->first()?->id ?? 0;


        Company::query()
            ->when(!is_null($request->code), function($query) use ($request) {
                return $query->where('code', $request->code)
                    ->orWhere('name', 'LIKE', '%'.$request->code.'%');
            })
            ->chunk(1000, function($companies) use ($client, $headers, &$balance_sheet_params,
            &$cash_flow_statement_params, &$profit_and_loss_statement_params, &$document_params,
            &$last_document_id) {
                foreach($companies as $company){
                    if(is_null($company->code)){
                        continue;
                    }
                    $response = $client->request('GET', config('jquants.statements'),[
                        'headers' => $headers,
                        'query' => [
                            'code' => $company->code
                        ]
                    ]);

                    $response_params = json_decode($response->getBody()->getContents());
                    foreach($response_params->statements as $response_param){
                        $last_document_id = $last_document_id ++;

                        $document_params = [
                            'id'            => $last_document_id,
                            'company_id'    => $company->id,
                            'type'          => $response_param->TypeOfCurrentPeriod,
                            'start_date'    => $response_param->CurrentPeriodStartDate,
                            'end_date'      => $response_param->CurrentPeriodEndDate
                        ];

                        $balance_sheet_params = [
                            'document_id' => $last_document_id,
                            'assets'      => $response_param->TotalAssets,
                            'equity'      => $response_param->Equity,
                            'liabilities' => (int)$response_param->TotalAssets - (int)$response_param->Equity
                        ];
                        
                        $profit_and_loss_statement_params = [
                            'document_id'       => $last_document_id,
                            'net_sales'         => $response_param->NetSales,
                            'operationg_profit' => $response_param->OperatingProfit,
                            'ordinary_profit'   => $response_param->OrdinaryProfit,
                            'profit'            => $response_param->Profit
                        ];

                        $cash_flow_statement_params = [
                            'document_id' => $last_document_id,
                            'operating'   => $response_param->CashFlowsFromOperatingActivities,
                            'investing'   => $response_param->CashFlowsFromInvestingActivities,
                            'financing'   => $response_param->CashFlowsFromFinancingActivities,
                            'cash'        => $response_param->CashAndEquivalents
                        ];
                    }
                }
            });

            Document::insert($document_params);
            BalanceSheet::insert($balance_sheet_params);
            ProfitAndLossStatement::insert($profit_and_loss_statement_params);
            CashFlowStatement::insert($cash_flow_statement_params);

            return to_route('document.create');
        }

}
