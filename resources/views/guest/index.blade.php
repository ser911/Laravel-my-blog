@extends('layouts.guest')

@section('pageTitle')
    BlogPress
@endsection

@section('content')

  <div class="row">
        <div class="col-md-8 blog-main">
         
            @foreach ($posts as $post)
                
          
          <div class="blog-post">
         <h2 class="blog-post-title">{{$post->title}}</h2>
         <small class="blog-post-meta">{{$post->date}}</small>
         <p>{{$post->content}}</p>
         <div class="pb-5">
             <a href="{{route('guest.posts.show', ['slug' => $post->slug])}}">Leggi l'articolo</a>

         </div>
         <!-- /.blog-post -->

            @endforeach
         
        </div><!-- /.blog-main -->

      </div><!-- /.row -->
      
  </div>
    
@endsection
