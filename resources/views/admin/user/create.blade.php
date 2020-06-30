@extends('layouts.admin')

@section('title')
    Daftar User
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Daftar Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
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
        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Foto Profil <i>(tidak wajib)</i></label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Jabatan</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
              <option value="user" selected>User/Pengguna</option>
              <option value="writer">Writer/Penulis</option>
              @can('isSuperAdmin')
              <option value="admin">Admin</option>
              <option value="SuperAdmin">SuperAdmin</option>
              @endcan
            </select>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <button class="btn btn-primary my-5"><i class="fas fa-check"></i> Simpan</button>
          <p><i>**Password default nya adalah "password".</i></p>
        </form>
      </div>
    </div>
@endsection