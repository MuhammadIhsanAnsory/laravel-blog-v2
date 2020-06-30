@extends('layouts.admin')

@section('title')
    Daftar User
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.profile') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
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
        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ $user->name }}">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Foto Profil</label>
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset('uploads/users') .'/'. $user->image   }}" alt="tidak ada foto profil" width="300px">
              </div>
              <div class="col-md-8">
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" required>
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <button class="btn btn-primary my-5"><i class="fas fa-check"></i> Simpan</button>
        </form>
      </div>
    </div>
@endsection