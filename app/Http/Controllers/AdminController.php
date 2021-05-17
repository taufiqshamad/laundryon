<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Auth};
use App\{Order, User};

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth.admin')->except(['login','auth']);
    }

    public function home()
    {
    	$orders    = Order::all()->sortBy('id',0,1);
    	return view('admin.home', compact(['orders']));
    }

    public function showBooking($id)
    {
    	$booking = Booking::find($id);
    	return view('admin.showBooking', compact('booking'));
    }

    public function updateHarga(Request $request, $id)
    {
    	$order         = Order::find($id);
    	$order->harga  = $request->harga;
    	if($order->save())
	    	return redirect()->route('admin.home')->with([
	    		'success' => 'Harga Berhasil Diupdate'
	    	]);
    }

    public function completeOrder($id)
    {
    	$order = Order::find($id);
    	$order->isComplete = true;
    	if($order->save())
    		return redirect()->route('admin.home')->with([
	    		'success' => 'Update Status Pesanan Berhasil'
	    	]);		
    }

    public function login()
    {
    	return view('admin.login');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required|min:3'
        ]);
        $email = $request->email;
        if(!Auth::attempt($request->only('email', 'password'))){
            // echo "L";
            // exit;
            Auth::logout();
            return redirect()->back()->with([
                'alert'=>'Email atau Password Salah',
                'email' => $email
            ]);
        }

        if(!Auth::user()->isAdmin){
            // echo "M";
            // exit;
            Auth::logout();
            return redirect()->back()->with([
                'alert'=>'Maaf, Anda Bukan Admin',
                'email' => $email
            ]);
        }
        // echo "D";
        // exit;
        return redirect()->route('admin.home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
