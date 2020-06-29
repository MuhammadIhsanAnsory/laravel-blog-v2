@extends('layouts.admin')

@section('title')
    Detail Post : {{ $post->title }}
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Daftar Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Post</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <h2 class="text-center">{{ $post->title }}</h2>
        <img src="{{ asset('uploads/posts'.'/'. $post->image) }}" alt="gambar tidak ada" style="width: 400px" class="d-flex justify-content-center mx-auto my-3">
        <p>Oleh : <strong><i>{{ $post->user->name }}</i></strong></p>
        <p>{{ $post->created_at->diffForHumans() }}</p>
        <table>
          <tr>  
            <th>Tag</th> 
            <th> : </th>
            <td>
              @foreach ($post->tags as $tag)
                <span class="badge badge-info">{{ $tag->name }}</span>
              @endforeach
            </td>
          </tr>
          <tr>  
            <th>Status</th> 
            <th> : </th>
            <td>
              @if ($post->status == 0)
                  <i class="text-warning">Tidak aktif</i>
              @else
                  <i class="text-success">Aktif</i>
              @endif 
            </td>
          </tr>
          <tr>
            <th>
              Kategori
            </th>
            <th> : </th>
            <td>
              @foreach ($post->categories as $category)
                <span class="badge badge-info">{{ $category->name }}</span>
              @endforeach
            </td>
          </tr>
        </table>
        <p>{!! $post->content !!}</p>
      </div>
    </div>
@endsection

