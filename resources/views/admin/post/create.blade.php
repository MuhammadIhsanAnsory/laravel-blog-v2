@extends('layouts.admin')

@section('title')
    Daftar User
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Daftar Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Post</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="categories">Kategori</label>
            <select name="categories[]" id="categories" multiple class="form-control @error('categories') is-invalid @enderror" required>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">-   {{ $category->name }}</option>
              @endforeach
            </select>
            @error('categories')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="tags">Tag</label>
            <select name="tags[]" id="tags" multiple class="form-control @error('tags') is-invalid @enderror" required>
              @foreach ($tags as $tag)
              <option value="{{ $tag->id }}">- {{ $tag->name }}</option>
              @endforeach
            </select>
            @error('tags')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea name="content" id="editor" cols="30" rows="10" required>{{ old('content') }}</textarea>
            @error('content')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Gambar Thumbnail</label>
            <input type="file" name="image" id="image" class="form-control @error('tags') is-invalid @enderror" accept="image/*" required value="{{ old('image') }}">
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button class="btn btn-primary my-5"><i class="fas fa-check"></i> Simpan</button>
        </form>
        <p><strong>Keterangan:</strong></p>
        <ul>
          <li><i>**Post otomatis berstatus tidak dipublish</i></li>
        </ul>
      </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
      var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
      };
    </script>
    <script>
      CKEDITOR.replace( 'editor' , options);
    </script>
@endsection