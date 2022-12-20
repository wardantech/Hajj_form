<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ClientAuthController extends Controller
{
    public function login(Request $request){
        if($request->has('phone')){
            $phone= Client::Where('phone', $request->phone)->first();
            if($phone){
                $client= Client::where('passport', $request->passport)->first();
                if($client){
                    // return "logged in";
                    // return view('client_dashboard.client_dashboard', compact('client'));
                    return redirect()->route('show-for-client', $client->id);
                }else{
                    return back()->with('message', 'Wrong passport!');
                }
            }else{
                return back()->with('message', 'Wrong phone!');
            }
        }
    }
}
