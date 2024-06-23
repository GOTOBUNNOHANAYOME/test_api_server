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

        $companies = Company::query()
            ->when(!is_null($request->code), function($query) use ($request) {
                return $query->where('code', $request->code);
            })
            ->chunk(1000, function($company) use ($client, $headers, &$balance_sheet_params,
            &$cash_flow_statement_params, &$profit_and_loss_statement_params, &$document_params) {
                
                $response = $client->request('GET', config('jquants.statements'),[
                    'headers' => $headers,
                    'query' => [
                        'code' => $company->code
                    ]
                ]);

                $response_params = $response->getBody()->getContents();
            });
    }
}
