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
        <div class="row">
          <div class="col-md-6 col-sm-12">
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
                        <form action="{{ route('admin.category.destroy', [$category->id, $category->slug]) }}" method="post">
                          @method('delete')
                          @csrf
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editcategory{{ $category->id }}">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button type="submit" class="btn btn-danger btn-sm" id="delete" onclick="confirm('Yakin hapus postingan?')"><i class="fas fa-trash"></i></button>
                        </form>
                        <div class="modal fade" id="editcategory{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <form action="{{ route('admin.category.update', [$category->id, $category->slug]) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                      <label for="name">Nama Kategori</label>
                                      <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                    </div>
                                    <strong>PERHATIAN!</strong>
                                    <p><i>Kategori tidak bisa diubah apabila sedang digunakan oleh suatu postingan. Untuk dapat ngubah nama kategori, hapus terlebih dahulu kategori didalam postingan!</i></p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                @empty
                    <tr>
                      <td colspan="6"><i>Kategori tidak ada.</i></td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="card mt-5">
              <div class="card-body shadow">
                <h4>Buat kategori baru</h4>
                <form action="{{ route('admin.category.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" class="form-control" required name="name">
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{ $categories->links() }}
      </div>
    </div>
@endsection

