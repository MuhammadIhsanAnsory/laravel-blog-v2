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
        <img class="d-block w-100" src="{{ asset('uploads/posts/bg1.jpg') }}" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="font-weight-bold">First slide label</h5>
          <p>
            <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</strong>
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('uploads/posts/bg2.jpg') }}" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="font-weight-bold">Second slide label</h5>
          <p>
            <strong>Deserunt, magnam dolorum minus quidem molestiae dolorem.</strong>
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('uploads/posts/bg3.jpg') }}" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="font-weight-bold">Third slide label</h5>
          <p>
            <strong>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</strong>
          </p>
        </div>
      </div>
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
  <h1>Selamat Datang di Kabar Burung</h1>
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
    </div>
    <div class="col-md-3">
      <h3 class="text-center">Kategori</h3>
      <ul>
        @foreach ($categories as $category)
          @if ($category->posts->count() > 0)
            <li><a href="" class="category-link">{{ $category->name }}</a></li>
          @endif
        @endforeach
      </ul>
      <hr>
      <h3 class="text-center">Tag</h3>
        @foreach ($tags as $key=>$tag)
          @if ($tag->posts->count() > 0)
            <a href="{{ route('front.tag', $tag->slug) }}"><span class="badge badge-info">{{ $tag->name }}</span></a>
          @endif
        @endforeach
    </div>
  </div>
  
  {{ $posts->links() }}
@endsection