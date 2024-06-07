<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FinanceController extends Controller
{
    public function getIdToken(Request $request)
    {
        $client = new Client();
        $params = [
            'refreshtoken' => config('services.jquants.refresh_key')
        ];

        $response = $client->request('POST', 'https://api.jquants.com/v1/token/auth_refresh?' . http_build_query($params), [
        ]);
        
        dd($response->getBody()->getContents());
    }
}
