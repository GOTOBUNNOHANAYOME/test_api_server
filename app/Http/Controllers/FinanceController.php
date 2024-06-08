<?php

namespace App\Http\Controllers;

use App\Models\{
    FinanceUser,
    QuantsMethod
};

use App\Enums\FinanceUserStatus;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FinanceController extends Controller
{
    public function createConfig(Request $request)
    {
        $finance_user = auth()->user()
            ->financeUsers()
            ?->where('status', FinanceUserStatus::COMPLETED)
            ->first();
        
        return view('finance.set_config', [
            'finance_user' => $finance_user
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
            'json' => json_encode($params)
        ]);

        $respons_params = json_decode($response->getBody()->getContents());


        if($response->getStatusCode() === 200 || is_null($respons_params['refreshToken'])){
            // return to_route();
        }
        
        $finance_user = FinanceUser::create([
            'email'    => $request->email,
            'password' => $request->password
        ]);
        QuantsMethod::create([
            'finance_user_id'          => $finance_user->id,
            'refresh_token'            => $respons_params['refreshToken'],
            'refresh_token_expired_at' => now()->addDays(14),
            'status'                   => FinanceUserStatus::COMPLETED
        ]);
        
        return to_route('finance.create_id_token');
    }

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

        $response = $client->request('POST', config('jquants.id_token') .'?' . http_build_query($params), [
        ]);

        if($response->getStatusCode() !== 200){
            // return to_route('finance.create_id_token'); エラー表示
        }

        $response_params = json_decode($response->getBody()->getContents());

        return to_route('finance.create_id_token');
    }
}
