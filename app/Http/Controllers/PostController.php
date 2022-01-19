<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(3); // COllections
        return view('posts.index',[
            'posts' => $posts
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'body'=> 'required'
        ]);
        $request->user()->posts()->create([
            'body' => $request->body
        ]);
        return back();
    }

    public function destroy(Post $post)
    {
        if(!$post->ownedby(auth()->user())){
            dd('no'); 
        }
        $post->delete();
        return back();
    }
}
