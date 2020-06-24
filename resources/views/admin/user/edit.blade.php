@extends('layouts.admin')

@section('title')
    Daftar User
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Daftar User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
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
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Foto Profil <i>(tidak wajib)</i></label>
            <div class="row">
              <div class="col-md-4">
                <img src="{{ asset('uploads/users') .'/'. $user->image   }}" alt="tidak ada foto profil" width="300px">
              </div>
              <div class="col-md-8">
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="image">Jabatan</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
              <option value="user" @if ($user->role == 'user') selected @endif>User/Pengguna</option>
              <option value="writer" @if ($user->role == 'writer') selected @endif>Writer/Penulis</option>
              <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
            </select>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <button class="btn btn-primary my-5"><i class="fas fa-check"></i> Simpan</button>
        </form>
      </div>
    </div>
@endsection