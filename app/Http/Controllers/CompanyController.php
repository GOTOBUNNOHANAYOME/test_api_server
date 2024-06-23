<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Enums\QuantsMethodStatus;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {   
        return view('company.index', [
            'companies' => Company::get()
        ]);
    }
    public function create(Request $request)
    {
        return view('company.create');
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
        $response = $client->request('GET', config('jquants.listed_info'),[
            'headers' => $headers
        ]);
        $companies = collect(json_decode($response->getBody()->getContents())->info);

        $company_params = [];
        $companies->chunk(500)->each(function($chunk) use ($company_params) {
            foreach($chunk as $company){
                $company_params[] = [
                    'code'           => $company->Code,
                    'name'           => $company->CompanyName,
                    'english_name'   => $company->CompanyNameEnglish,
                    'sector_17_code' => $company->Sector17Code,
                    'sector_33_code' => $company->Sector33Code,
                    'scale_category' => $company->ScaleCategory,
                    'market_code'    => $company->MarketCode,
                    'listed_at'      => $company->Date
                ];
            }
            Company::insert($company_params);
            $company_params = [];
        });


        return to_route('company.create');
    }
}
