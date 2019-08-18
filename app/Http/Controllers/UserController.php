<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user.index', compact('user'));
    }

	public function follow(Request $request, $id)
	{
		if($request->user()->canFollow($id)) {
	        $request->user()->following()->attach($id);
	        return array('res' => True);
	    }

	    return array('res' => False);
	}

	public function unFollow(Request $request, $id)
	{
	    if($request->user()->canUnFollow($id)) {
	    	$request->user()->following()->detach($id);
	    	return array('res' => True);
	    }
	      
	    return array('res' => False);
	}

	public function followingList(Request $request)
	{
		return User::where('id', $request->get('id'))->with('following')->first();
	}

	public function canFollow(Request $request)
	{
		return $request->user()->following->where('id', $request->id)->count();
	}
}
