<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ClientAuthController extends Controller
{
    public function login(Request $request){
        if($request->has('username')){
            $client= Client::where('passport', $request->username)->orWhere('phone', $request->username)->first();
            if($client){
                return view('client_dashboard.client_dashboard', compact('client'));
            }
        }
    }
}
