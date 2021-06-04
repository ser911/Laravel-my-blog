@extends('layouts.base')

@section('pageTitle')
<h1>{{$post->title}}</h1>
    
@endsection
@section('content')

<hr>
    <div class="mt-5">
       
        <small>{{$post->date}}</small>
        <p>{{$post->content}}</p>
        <div>
         @foreach ($post->tags as $tag)
            <span class="badge badge-primary"> {{$tag->name}} </span>
         @endforeach

        </div>

    </div>   
    <div class="mt-5">
        
        
        @if ($post->comments->isNotEmpty())          
      
<h5>Commenti</h5>

<ul class="list-group">
     @foreach ($post->comments as $comment)
         
        <li class="list-group-item">  
               {{$comment->name ? $comment->name : 'Anonimo'}}
               
        </li>  
        <li class="list-group-item-primary none">
               {{$comment->content}}    
        </li>

        <div class="p-2">
        <form action="{{route('admin.comments.destroy', ['comment' => $comment->id])}}" method="POST">
        
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        
        </div>       
     
     @endforeach
     </form>
</ul>
</div>
@endif
<div class="pt-5">
    <a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>

</div>

@if (session('message'))
    <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
        {{ session('message') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
@endif

   @endsection