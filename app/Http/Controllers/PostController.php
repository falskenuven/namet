<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('post.index');
    }

    public function read(Request $request, $post_id)
    {
        $post = Post::where('id', $post_id)->with('user')->first();
        return view('post.read')->with('post', $post);
    }

    public function index(Request $request, Post $post)
    {
        $posts = $post->whereIn('user_id', $request->user()->following()
            ->pluck('users.id')
            ->push($request->user()->id))
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take($request->get('limit', 10))
            ->get();
          
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $newPost = $request->user()->posts()->create([
            'title' => $request->get('title'),
            'article' => $request->get('article'),
            'group_id' => $request->get('group_id')
        ]);
        return $request;
        return response()->json(Post::where('id', $newPost->id)->with('user')->get());
    }

    public function list(Request $request, $page)
    {
        $per_page = 5;

    	return Post::where('user_id', $request->get('id'))->orderBy('created_at', 'desc')->paginate($per_page, ['*'], 'page', $page);
    }

    public function edit(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        if($post->user_id == $request->user()->id) {
            return view('post.edit')->with('post', $post);
        }
        else {
            return 'Permission denied';
        }
    }

    public function update(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->title = $request->get('title');
        $post->article = $request->get('article');

        $post->save();

        return response()->json('successfully updated');
    }

    public function delete(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        $user = $request->user();

        if($post->user_id == $user->id || $user->role === 1) {
            $post->delete();
        } else {
            return 'Permission denied';
        }

        return response()->json('successfully deleted');
    }

    public function find(Request $request)
    {
        $findPost = Post::where('title', 'LIKE', '%'.$request->get('search').'%')->with('user')->limit(10)->get();

        return response()->json($findPost);
    }

}
