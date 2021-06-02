@extends('layouts.base')

@section('pageTitle')
    Write a new post
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


  <form action="{{route('admin.posts.store')}}" method="POST">
      
    @csrf
    @method('post')

    <div class="form-group">
        <label for="title">Titolo</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="titolo">
    </div>

    <div class="form-group">
        <label for="date">Data</label>
        <input type="date" class="form-control" id="date" name="date" placeholder="data">
    </div>

    <div class="form-group">
        <label for="content">Contenuto</label>
        <textarea class="form-control" id="content" cols="30" rows="10" name="content" placeholder="contenuto"></textarea>
    </div>
     <div class="form-group">
        <label for="image">Immagine</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="immagine">
    </div>

       <div class="form-check form-check-inline">
         <input type="checkbox" class="form-check-input" id="published" name="published">
         <label for="published" class="form-check-label">Pubblica</label>
    </div>
     
    <div class="mt-3">
<h3>Tags</h3>
@foreach ($tags as $tag)
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="tags[]" id="{{$tag->name}}" value="{{$tag->id}}">
        <label for="{{$tag->name}}" class="form-check-label">{{$tag->name}}</label>
    </div>
@endforeach

    </div>

 
    
    <div class="mt-3">
    <button type="submit" class="btn btn-primary">Crea post</button>
    </div>
  </form>
<div class="mt-5">
    <a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>

</div>

@endsection