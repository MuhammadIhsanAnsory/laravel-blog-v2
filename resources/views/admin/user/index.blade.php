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
              <th>Foto Profil</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Aksi<br><small>Detail | Edit | Nonaktifkan</small></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $key=>$user)
                <tr>
                  <td>{{ $users->firstItem() + $key }}</td>
                  <td><img src="{{ asset('uploads/users') .'/'. $user->image   }}" alt="Foto profil" style="width: 60px"></td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if ($user->role == 'SuperAdmin')
                      <span class="badge badge-danger">{{ $user->role }}</span>
                    @endif
                    @if ($user->role == 'admin')
                      <span class="badge badge-warning">{{ $user->role }}</span>
                    @endif
                    @if ($user->role == 'writer')
                      <span class="badge badge-success">{{ $user->role }}</span>
                    @endif
                    @if ($user->role == 'user')
                      <span class="badge badge-primary">{{ $user->role }}</span>
                    @endif
                  </td>
                  <td>
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                      @method('delete')
                      @csrf
                      <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                      <button type="submit" class="btn btn-warning btn-sm" id="delete" onclick="confirm('Nonaktifkan user?')"><i class="fas fa-ban"></i></button>
                    </form>
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

