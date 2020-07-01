@extends('layouts.front')

@section('title')
    {{ $post->title }} - Kabar Burung
@endsection

@section('content')
  <nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
    </ol>
  </nav>
  <div class="row mt-5">
    <div class="col-md-9">
      <h1 class="text-center">{{ $post->title }}</h1>
      <div class="text-secondary">
        Kabar Burung | {{ $post->created_at->diffForHumans() }} | Oleh : {{ $post->user->name }}
      </div>
      <img src="{{ asset('uploads/posts/'. $post->image) }}" alt="" class="post-image my-3">
      <p>
        {!! $post->content !!}
      </p>
    </div>
    <div class="col-md-3">
      <h3>Tag</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis voluptatem facilis mollitia expedita. Accusamus error incidunt ratione nisi sunt ex, et non iste voluptatibus vitae, quae dolorum adipisci dolor exercitationem!</p>
    </div>
  </div>
@endsection