<?php

namespace App\Http\Controllers;

use App\Models\{
    QuantsMethod
};

use App\Enums\QuantsMethodStatus;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FinanceController extends Controller
{
    public function createConfig(Request $request)
    {
        $quants_method = auth()->user()
            ?->quantsMethods()
            ?->where('status', QuantsMethodStatus::COMPLETED)
            ?->first();
        
        return view('finance.create_config', [
            'quants_method' => $quants_method
        ]);
    }

    public function storeConfig(Request $request)
    {
        $client = new Client();

        $params = [
            'mailaddress' => $request->email,
            'password'    => $request->password
        ];
        $response = $client->request('POST', config('jquants.refresh_token'), [
            'json' => $params
        ]);

        $response_params = json_decode($response->getBody()->getContents());

        if($response->getStatusCode() === 200 || is_null($response_params->refreshToken)){
            // return to_route();
        }
        
        $params = [
            'refreshtoken' => $response_params->refreshToken
        ];

        $response = $client->request('POST', config('jquants.id_token') .'?' . http_build_query($params), [
        ]);

        if($response->getStatusCode() !== 200){
            // return to_route('finance.create_id_token'); エラー表示
        }

        $response_params = json_decode($response->getBody()->getContents());
        
        $quants_method =  QuantsMethod::create([
            'user_id'                  => auth()->id(),
            'email'                    => $request->email,
            'password'                 => $request->password,
            'id_token'                 => $response_params->idToken,
            'status'                   => QuantsMethodStatus::COMPLETED
        ]);


        return to_route('finance.create_config');
    }
}
