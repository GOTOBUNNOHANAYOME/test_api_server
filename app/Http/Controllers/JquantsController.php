<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class JquantsController extends Controller
{
    public function getToken(Request $request)
    {
        $client = new Client();
        $params = [
            'refreshtoken' => config('service.jquants.refresh_key')
        ];

        $response = $client->request('POST', 'https://api.jquants.com/v1/token/auth_refresh', [
            'query' => $params
        ]);

        dd($response->getBody()->getContents());
    }
}
