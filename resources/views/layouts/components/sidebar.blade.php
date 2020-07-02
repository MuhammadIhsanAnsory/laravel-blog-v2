
<h3 class="mt-5">Kategori</h3>
<ul>
  @foreach ($categories as $category)
    @if ($category->posts->count() > 0)
      <li><a href="{{ route('front.category', $category->slug) }}" class="category-link">{{ $category->name }}</a></li>
    @endif
  @endforeach
</ul>
<hr>
<h3 class="mt-5">Tag</h3>
@foreach ($tags as $key=>$tag)
  @if ($tag->posts->count() > 0)
    <a href="{{ route('front.tag', $tag->slug) }}"><span class="badge badge-info">#{{ $tag->name }}</span></a>
  @endif
@endforeach

<h3 class="mt-5">Artikel Lainnya</h3>
<ul class="list-unstyled">
  @foreach ($random_posts as $post)
  <li class="media my-2">
    <img class="mr-3" height="70px" width="70px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="berita">
    <div class="media-body">
      <a href="{{ route('front.show', [$post->id, $post->slug]) }}">
        <p class="font-weight-bold mt-0 mb-1 text-dark">{{ $post->title }}</p>
      </a>
      <small><i>{{ $post->created_at->diffForHumans() }}</i></small>
    </div>
  </li>
  @endforeach
</ul>
