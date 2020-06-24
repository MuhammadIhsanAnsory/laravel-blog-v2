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
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Foto Profil</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Aksi<br><small>Aktifkan | Detail | Edit | Nonaktifkan</small></th>
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
                      <a href="{{ route('admin.user.restore', $user->id) }}" class="btn btn-info btn-sm" onclick="confirm('Aktifkan user?')"><i class="fas fa-check"></i></a>
                      <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('admin.user.burn', $user->id) }}" class="btn btn-danger btn-sm" onclick="confirm('Hapus user?')"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
            @empty
                <tr>
                  <td colspan="4"><i>User nonaktif tidak ada</i></td>
                </tr>
            @endforelse
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
@endsection

