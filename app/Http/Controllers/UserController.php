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

	public function followDis(User $user)
	{
	    return view('user.follow', compact('user'));
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

	public function followersList(Request $request)
	{
		return User::where('id', $request->user()->id)->with('followers')->first();
	}

	public function canFollow(Request $request)
	{
		return $request->user()->following->where('id', $request->id)->count();
	}

	public function find(Request $request)
    {
        $findUser= User::where('name', 'LIKE', '%'.$request->get('search').'%')
        	->whereNotIn('role', [1])
        	->limit(10)
        	->get();

        return response()->json($findUser);
    }

    public function delete(Request $request, $user_id)
    {
        $user_f = User::find($user_id);
        $user = $request->user();

        if($user->id == $user_f->id || $user->role === 1) {
            $user_f->delete();
        } else {
            return 'Permission denied';
        }

        return response()->json('successfully deleted');
    }
}
