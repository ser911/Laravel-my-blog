<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
           //validation
        $request ->validate([
        'title' => 'required|string|max:255|unique:posts',
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|url'
        ]);
            
       //submission
        $data = $request->all();

        if (!isset($data['published']) ){

             $data['published'] = false;

        }
        else{
              $data['published'] = true;
        }

        $data['slug'] = Str::slug($data['title'], '-');

        $newPost = Post::create($data);

        if(isset($data['tags'])){
         
       $newPost->tags()->attach($data['tags']); 
        
    }
       // redirect

       return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
          return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all(); 
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
            //validation
        $request ->validate([
        'title' => 'required|string|max:255|unique:posts,title,' .$post->id,
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|url'
        ]);
            
       //submission
        $data = $request->all();

        if (!isset($data['published']) ){

             $data['published'] = false;

        }
        else{
              $data['published'] = true;
        }

        $data['slug'] = Str::slug($data['title'], '-');

    
    
       $post->update($data);

        if(!isset($data['tags'])){
            $data['tags'] = [];
        }
           
       $post->tags()->sync($data['tags']);

       return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Post eliminato!');
    }
}
