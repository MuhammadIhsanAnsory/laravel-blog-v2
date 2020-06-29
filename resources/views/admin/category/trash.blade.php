@extends('layouts.admin')

@section('title')
    Daftar Post
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Kategori</th>
              <th>Digunakan</th>
              <th>
                Aksi<br><small>Edit | Hapus</small><br>
                <button disabled class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                <button disabled class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $key=>$category)
              <tr>
                <td>{{ $categories->firstItem() + $key }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->posts->count() }} post</td>
                <td>
                    <a href="{{ route('admin.category.restore', [$category->id, $category->slug]) }}" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i></a>

                    <a href="{{ route('admin.category.forceDelete', [$category->id, $category->slug]) }}" class="btn btn-danger btn-sm" onclick="confirm('Yakin hapus permanen kategori?')"><i class="fas fa-trash"></i></a>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6"><i>Kategori tidak ada.</i></td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {{ $categories->links() }}
      </div>
    </div>
@endsection

