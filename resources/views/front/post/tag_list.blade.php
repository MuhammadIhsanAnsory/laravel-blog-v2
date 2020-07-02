@extends('layouts.front')

@section('title')
    Kabar Burung - Portal Berita Lengkap
@endsection

@section('content')
  <h2 class="mt-4"><i class="fas fa-tags text-secondary"></i>  Berita {{ $tag->name }}</h2>
  <div class="row">
    <div class="col-md-9">
      <?php foreach($tag->posts as $post) : ?> 
        <div class="media my-4">
          <a href="{{ route('front.show', [$post->id, $post->slug]) }}">
            <img class="mr-3" height="150px" width="150px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="gambar berita">
          </a>
          <div class="media-body">
            <a href="{{ route('front.show', [$post->id, $post->slug]) }}" class="media-title">
              <h5 class="font-weight-bold mt-0">{{ $post->title }}</h5>
            </a>
            <i>{{ $post->created_at->diffForHumans() }}</i>
            <p>{!! Str::limit($post->content, 200, '...') !!}</p>
              <i class="fas fa-tags text-secondary"></i> <small>tag :</small>
              <br>
              <?php foreach($post->tags as $tag) : ?>
                <span class="badge badge-info">{{ $tag->name }}</span>
              <?php endforeach; ?>
          </div>
        </div>
        <hr>
      <?php endforeach; ?>
    </div>
    <div class="col-md-3">
      @include('layouts.components.sidebar')
    </div>
  </div>
@endsection