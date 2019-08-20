<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function block(Request $request)
    {
    	// return $request->get('time');
    	$date = date("Y-m-d", strtotime($request->get('time')));

    	$user = User::where('id', '=', $request->get('id'))->first();
    	$user->disabled = $date;
    	$user->save();

        return $date;
    }

    public function clear(Request $request)
    {
    	$user = User::where('id', '=', $request->get('id'))->first();
    	$user->disabled = null;
    	$user->save();

        return 'Success';
    }
}
