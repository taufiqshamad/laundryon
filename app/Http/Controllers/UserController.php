<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __constuct()
    {
    	$this->middleware('auth');
    }

    public function account()
    {
    	$user = Auth::user();
    	$orders = $user->order->sortBy('id', 0, true);
    	return view('account',compact('user','orders'));
    }
}
