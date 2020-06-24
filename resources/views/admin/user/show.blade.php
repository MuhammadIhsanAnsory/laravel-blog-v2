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
            <li class="breadcrumb-item active" aria-current="page">Detail User</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <h3 class="text-center mb-4">Detail User</h3>
        <div class="row">
          <div class="col-md-4">
            <img src="{{ asset('uploads/users') .'/'. $user->image   }}" alt="Foto profil" style="width: 360px">
          </div>
          <div class="col-md-8">
            <table class="table table-striped table-hover">
              <tr>
                <th>Nama</th>
                <td>:</td>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>:</td>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>Jabatan</th>
                <td>:</td>
                <td>
                  @if ($user->role == 'admin')
                    <span class="badge badge-danger">{{ $user->role }}</span>
                  @endif
                  @if ($user->role == 'writer')
                    <span class="badge badge-success">{{ $user->role }}</span>
                  @endif
                  @if ($user->role == 'user')
                    <span class="badge badge-primary">{{ $user->role }}</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Bergabung</th>
                <td>:</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
              </tr>
            </table>
          </div>
        </div>
          
      </div>
    </div>
@endsection 