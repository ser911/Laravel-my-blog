<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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

}

