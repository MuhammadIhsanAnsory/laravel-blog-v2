@extends('layouts.admin')

@section('title')
    Daftar Post
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><strong>Daftar Post{{ request()->is('admin/post/aktif') ? ' Aktif' : '' }}{{ request()->is('admin/post/tidak-aktif') ? ' Tidak Aktif' : '' }}</strong></li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <a href="{{ route('admin.post.index') }}" class="btn btn-block btn-success btn-sm">Post Aktif</a>
          </div>
          <div class="col-md-6">
            <a href="{{ route('admin.post.postNonactive') }}" class="btn btn-block btn-secondary btn-sm">Post Tidak Aktif</a>
          </div>
        </div>
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Post</a>
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
                Aksi<br><small>{{ request()->is('admin/post/aktif*') ? 'Nonaktifkan' : 'Aktifkan' }} | Edit | Status | Hapus</small><br>
                @if (request()->is('admin/post/tidak-aktif*'))
                <button disabled class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                @endif
                @if (request()->is('admin/post/aktif*'))
                <button disabled class="btn btn-warning btn-sm"><i class="fas fa-ban"></i></button>
                @endif
                <button disabled class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                <button disabled class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
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
                    <form action="{{ route('admin.post.destroy', [$post->id, $post->slug]) }}" method="post">
                      @method('delete')
                      @csrf
                      @can('publish', $post)
                        @if (request()->is('admin/post/tidak-aktif*'))
                        <a href="{{ route('admin.post.publish', [$post->id, $post->slug]) }}" class="btn btn-success btn-sm"  onclick="confirm('Publish postingan ini?')"><i class="fas fa-check"></i></a>
                        @endif
                        @if (request()->is('admin/post/aktif*'))
                        <a href="{{ route('admin.post.unpublish', [$post->id, $post->slug]) }}" class="btn btn-warning btn-sm"  onclick="confirm('Unpublish postingan ini?')"><i class="fas fa-ban"></i></a>
                        @endif
                      @endcan
                      <a href="{{ route('admin.post.show', [$post->id, $post->slug]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                      @can('update', $post)
                      <a href="{{ route('admin.post.edit', [$post->id, $post->slug]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                      @endcan
                      @can('delete', $post)
                      <button type="submit" class="btn btn-danger btn-sm" id="delete" onclick="confirm('Yakin hapus postingan?')"><i class="fas fa-trash"></i></button>
                      @endcan
                    </form>
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

