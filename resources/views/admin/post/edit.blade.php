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
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
          </ol>
        </nav>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.post.update', [$post->id, $post->slug]) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ $post->title }}">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for=""><strong>Kategori</strong></label>
            <div class="row">
              @foreach ($categories as $category)
                <div class="col-md-3">
                  <div class="roem-check">
                    <input type="checkbox" name="categories[]" id="categories" multiple class="form-check-input" value="{{ $category->id }}" 
                    @foreach ($post->categories as $value)
                        @if ($category->id == $value->id)
                            checked
                        @endif
                    @endforeach>
                    <label for="categories" class="form-check-label">{{ $category->name }}</label>
                  </div>
                </div>
              @endforeach
            </div>
            @error('categories')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for=""><strong>Tag</strong></label>
            <div class="row">
              @foreach ($tags as $tag)
                <div class="col-md-2">
                  <div class="roem-check">
                    <input type="checkbox" name="tags[]" id="tags" multiple class="form-check-input" value="{{ $tag->id }}" 
                    @foreach ($post->tags as $value)
                        @if ($tag->id == $value->id)
                            checked
                        @endif
                    @endforeach>
                    <label for="tags" class="form-check-label">{{ $tag->name }}</label>
                  </div>
                </div>
              @endforeach
            </div>
            @error('tags')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea name="content" id="editor" cols="30" rows="10" required>{{ $post->content }}</textarea>
            @error('content')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Gambar Thumbnail</label>
            <br>
            <img src="{{ asset('uploads/posts').'/' .$post->image }}" alt="gambar tidak ada" style="width: 300px">
            <input type="file" name="image" id="image" class="form-control mt-3 @error('tags') is-invalid @enderror" accept="image/*" value="{{ old('image') }}">
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button class="btn btn-primary my-5"><i class="fas fa-check"></i> Simpan</button>
        </form>
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