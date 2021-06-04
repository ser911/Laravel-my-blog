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

<div class="mt-5">
    <h3>Aggiungi commento</h3>
<form action="{{route('guest.posts.add-comment', ['post' => $post->id])}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="title">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
    </div>

    <div class="form-group">
        <label for="content">Commento</label>
        <textarea class="form-control" id="content" cols="30" rows="10" name="content" placeholder="commento"></textarea>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Inserisci</button>
    </div>

    </form>

<div class="pt-5">
    <a href="{{route('guest.posts.index')}}">Torna all'home page</a>

</div>
</div>

   @endsection