@extends('layouts.admin')

@section('title')
    Daftar User
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm mb-4"><i class="fas fa-user-plus"></i> Tambah User</a>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $key=>$user)
                <tr>
                  <td>{{ $key }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
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
                  <td>
                    <a href="">Detail</a>
                    <a href="">Edit</a>
                    <a href="">Nonaktifkan</a>
                  </td>
                </tr>
            @empty
                <tr>
                  <td colspan="4">User tidak ada</td>
                </tr>
            @endforelse
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
@endsection