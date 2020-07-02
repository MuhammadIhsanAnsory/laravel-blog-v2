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
      <img src="{{ asset('uploads/posts/'. $post->image) }}" alt="" class="post-image my-3 img-resposive">
      <p>
        {!! $post->content !!}
      </p>
      @foreach ($tags as $key=>$tag)
        @if ($tag->posts->count() > 0)
          <a href="{{ route('front.tag', $tag->slug) }}"><span class="badge badge-info">{{ $tag->name }}</span></a>
        @endif
      @endforeach
      <h3>Artikel Terkait</h3>
      <div class="row">
        @foreach ($related_posts as $post)
        <div class="col-md-4">
          <div class="card my-2">
            <a href="{{ route('front.show', [$post->id, $post->slug]) }}">
              <div class="card-header">
                <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="gambar berita" class="related-post img-responsive">
              </div>
              <div class="card-body">
                <p class="text-dark font-weight-bold">{{ $post->title }}</p>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-3">
      @include('layouts.components.sidebar')
    </div>
  </div>
@endsection