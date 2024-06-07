<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FinanceController extends Controller
{
    public function createIdToken(Request $request)
    {
        return view('finance.create_id_token');
    }
    public function getIdToken(Request $request)
    {
        $client = new Client();
        $params = [
            'refreshtoken' => config('services.jquants.refresh_key')
        ];

        $response = $client->request('POST', 'https://api.jquants.com/v1/token/auth_refresh?' . http_build_query($params), [
        ]);

        if($response->getStatusCode() !== 200){
            // return to_route('finance.create_id_token'); エラー表示
        }

        $response_params = json_decode($response->getBody()->getContents());

        return to_route('finance.create_id_token');
    }
}
