<?php

namespace App\Http\Controllers;

use App\Enums\QuantsMethodStatus;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StatementsController extends Controller
{
    public function create()
    {

    }

    public function store()
    {
        $quants_method = auth()->user()
        ?->quantsMethods()
        ?->where('status', QuantsMethodStatus::COMPLETED)
        ?->first();

        $headers = [
            'Authorization' => 'Bearer ' . $quants_method->id_token,
        ];
        $client = new Client();
        $response = $client->request('GET', 'https://api.jquants.com/v1/fins/statements?code='. Company::first()->code,[
            'headers' => $headers
        ]);
    }
}
