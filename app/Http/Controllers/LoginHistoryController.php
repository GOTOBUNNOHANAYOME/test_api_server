<?php

namespace App\Http\Controllers;

use App\Models\{
    LoginHistory,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginHistoryController extends Controller
{
    public function create(Request $request)
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            // ->where('password', Hash::make($request->password))
            ->first();
        auth()->login($user);
        LoginHistory::create([
            'user_id'    => auth()->id(),
            'user_agent' => $request->header('User-Agent'),
            'ip'         => get_request_ip(),
        ]);

        return to_route('finance.create_config');
    }
}
