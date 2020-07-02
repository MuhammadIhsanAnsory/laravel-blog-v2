@extends('layouts.front')

@section('title')
    Kabar Burung - Portal Berita Lengkap
@endsection

@section('content')
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100 img-carousel" src="{{ asset('uploads/posts/' . $posts[0]->image) }}" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <a href="{{ route('front.show', [$posts[0]->id, $posts[0]->slug]) }}">
            <h5 class="font-weight-bold text-white">{{ $posts[0]->title }}</h5>
          </a>
        </div>
      </div>
      @for ($i = 1; $i < 3; $i++)
      <div class="carousel-item">
        <img class="d-block w-100 img-carousel" src="{{ asset('uploads/posts/' . $posts[$i]->image) }}" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <a href="{{ route('front.show', [$posts[$i]->id, $posts[$i]->slug]) }}">
            <h5 class="font-weight-bold text-white">{{ $posts[$i]->title }}</h5>
          </a>
        </div>
      </div>
      @endfor
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <h1 class="text-center">Selamat Datang di Kabar Burung</h1>
  <h2>Berita Terbaru</h2>
  <div class="row">
    <div class="col-md-9">
      <?php foreach($posts as $post) : ?> 
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
      <a href="{{ route('front.latest') }}" class="btn btn-primary inline-block justify-content-center">Berita terbaru selengkapnya...</a>
    </div>
    <div class="col-md-3">
      @include('layouts.components.sidebar')
    </div>
  </div>
  
@endsection