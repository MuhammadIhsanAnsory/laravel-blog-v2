@extends('layouts.admin')

@section('title')
    Daftar Post
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Post</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <a href="#" class="btn btn-block btn-success btn-sm">Post Aktif</a>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-block btn-secondary btn-sm">Post Tidak Aktif</a>
          </div>
        </div>
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Post</a>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Penulis</th>
              <th>Kategori</th>
              <th>Tag</th>
              <th>Aksi<br><small>Detail | Edit | Status | Hapus</small></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $key=>$post)
                <tr>
                  <td>{{ $posts->firstItem() + $key }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>
                    @foreach ($post->categories as $category)
                        <span class="badge badge-primary">{{ $category->name }}</span>
                    @endforeach
                  </td>
                  <td>
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                  </td>
                </tr>
            @empty
                <tr>
                  <td colspan="6"><i>Post tidak ada.</i></td>
                </tr>
            @endforelse
          </tbody>
        </table>
        {{ $posts->links() }}
      </div>
    </div>
@endsection

