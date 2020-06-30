@extends('layouts.admin')

@section('title')
    Sampah
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Daftar Tag</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sampah</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Tag</th>
              <th>
                Aksi<br><small>Restore | Hapus</small><br>
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
                <td>
                    <a href="{{ route('admin.tag.restore', [$tag->id, $tag->slug]) }}" class="btn btn-success btn-sm"><i class="fas fa-trash-restore"></i></a>

                    <a href="{{ route('admin.tag.forceDelete', [$tag->id, $tag->slug]) }}" class="btn btn-danger btn-sm" onclick="confirm('Yakin hapus permanen Tag?')"><i class="fas fa-trash"></i></a>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6"><i>Tag tidak ada.</i></td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {{ $tags->links() }}
      </div>
    </div>
@endsection

