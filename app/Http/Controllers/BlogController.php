<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->get();
           
         return view('guest.index', compact('posts'));
    }
    
    public function show($slug){

        //retrieve data from db
        $post = Post::where('slug', $slug)->first();
        
        //if slug incorrect -> 404 custom page
        if ($post == null) {
            abort(404);
        }
        // if slug correct
        return view('guest.show', compact('post'));
    }
    public function addComment(Request $request, Post $post)
    {
      $request->validate([
          'name'=> 'nullable|string|max:100',
          'content' => 'required|string',
      ]);
       
      $newComment = new Comment();
      $newComment->name = $request->name;
      $newComment->content = $request->content;
      $newComment->post_id = $post->id;
     
      $newComment->save();

      return back();


    }

}

