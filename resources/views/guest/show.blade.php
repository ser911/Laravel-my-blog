@extends('layouts.guest')

@section('pageTitle')
    {{$post->title}}
@endsection

@section('content')

    <div class="mt-5">
       
        <h1>{{$post->title}}</h1>
        <small>{{$post->date}}</small>
        <p>{{$post->content}}</p>

    </div>   
    <div class="mt-5">
        
        
        @if ($post->comments->isNotEmpty())          
      
<h5>Commenti</h5>

<ul class="list-group">
     @foreach ($post->comments as $comment)
         
        <li class="list-group-item-primary none">  
               {{$comment->name}}
               
        </li>  
        <li class="list-group-item">
               {{$comment->content}}    
        </li>       
     
     @endforeach
</ul>

</div>
@endif
<div class="pt-5">
    <a href="{{route('guest.posts.index')}}">Torna all'home page</a>

</div>

   @endsection