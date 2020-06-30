@extends('layouts.admin')

@section('title')
    Daftar Tag
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Tag</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
            <li >{{ $error }}</li>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif 
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Tag</th>
                  <th>Digunakan</th>
                  <th>
                    Aksi<br><small>Edit | Hapus</small><br>
                    <button disabled class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                    <button disabled class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($tags as $key=>$tag)
                    <tr>
                      <td>{{ $tags->firstItem() + $key }}</td>
                      <td>{{ $tag->name }}</td>
                      <td>{{ $tag->posts->count() }} post</td>
                      <td>
                        <form action="{{ route('admin.tag.destroy', [$tag->id, $tag->slug]) }}" method="post">
                          @method('delete')
                          @csrf
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edittag{{ $tag->id }}">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button type="submit" class="btn btn-danger btn-sm" id="delete" onclick="confirm('Yakin hapus postingan?')"><i class="fas fa-trash"></i></button>
                        </form>
                        <div class="modal fade" id="edittag{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <form action="{{ route('admin.tag.update', [$tag->id, $tag->slug]) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                      <label for="name">Nama Tag</label>
                                      <input type="text" name="name" value="{{ $tag->name }}" class="form-control">
                                    </div>
                                    <strong>PERHATIAN!</strong>
                                    <p><i>Tag tidak bisa diubah apabila sedang digunakan oleh suatu postingan. Untuk dapat ngubah nama Tag, hapus terlebih dahulu Tag didalam postingan!</i></p>
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
                      <td colspan="6"><i>Tag tidak ada.</i></td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="card mt-5">
              <div class="card-body shadow">
                <h4>Buat Tag baru</h4>
                <form action="{{ route('admin.tag.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama Tag</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" required name="name">
                  </div>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{ $tags->links() }}
      </div>
    </div>
@endsection

