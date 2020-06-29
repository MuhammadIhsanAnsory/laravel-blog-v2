@extends('layouts.admin')

@section('title')
    Daftar Post
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Daftar Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sampah</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Penulis</th>
              <th>Dibuat</th>
              <th>Kategori</th>
              <th>Tag</th>
              <th>
                Aksi<br><small>Restore | Hapus</small><br>
                <button disabled class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i></button>
                <button disabled class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                <button disabled class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $key=>$post)
                <tr>
                  <td>{{ $posts->firstItem() + $key }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->created_at->diffForHumans() }}</td>
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
                  <td>
                    @can('forceDelete', $post)
                    <a href="{{ route('admin.post.restore', [$post->id, $post->slug]) }}" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i></a>
                    @endcan
                    <a href="{{ route('admin.post.show', [$post->id, $post->slug]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                    @can('forceDelete', $post)
                    <a href="{{ route('admin.post.forceDelete', [$post->id, $post->slug]) }}" class="btn btn-danger btn-sm" onclick="confirm('Yakin hapus permanen postingan ini?')"><i class="fas fa-trash"></i></a>
                    @endcan
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

