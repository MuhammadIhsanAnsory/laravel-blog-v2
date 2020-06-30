<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->orderBy('created_at', 'desc')->paginate(25);

    return view('admin.post.index', compact('posts'));
  }


  public function postNonactive()
  {
    $posts = Post::where('status', 0)->with(['user', 'categories', 'tags'])->orderBy('created_at', 'desc')->paginate(25);
    // dd($posts);
    return view('admin.post.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::orderBy('name', 'asc')->get();
    $tags = Tag::orderBy('name', 'asc')->get();
    return view('admin.post.create', compact('categories', 'tags'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|min:5',
      'categories' => 'required',
      'tags' => 'required',
      'content' => 'required|min:10',
      'image' => 'required|image|mimes:jpg,jpeg,png',
    ]);

    $user = auth()->user();
    $file = $request->file('image');
    $file_name = time() . $file->getClientOriginalName();
    $destination = public_path('/uploads/posts/');
    $file->move($destination, $file_name);

    $post = Post::create([
      'user_id' => $user->id,
      'title' => $request->title,
      'content' => $request->content,
      'slug' => Str::slug($request->title),
      'image' => $file_name,
      'status' => 0,
    ]);


    $post->categories()->attach($request->categories);
    $post->tags()->attach($request->tags);

    Alert::success('Berhasil!', 'Post berhasil diupload!');

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $post = Post::withTrashed()->with(['user', 'categories', 'tags'])->findOrFail($id);
    return view('admin.post.show', compact('post'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = Post::withTrashed()->with(['user', 'categories', 'tags'])->findOrFail($id);
    $this->authorize('update', $post);
    $categories = Category::orderBy('name', 'asc')->get();
    $tags = Tag::orderBy('name', 'asc')->get();

    return view('admin.post.edit', compact('post', 'categories', 'tags'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required|min:5',
      'categories' => 'required',
      'tags' => 'required',
      'content' => 'required|min:10',
      'image' => 'image|mimes:jpg,jpeg,png',
    ]);

    $post = Post::withTrashed()->findOrFail($id);
    $this->authorize('update', $post);

    $file_name = $post->image;
    $user = auth()->user();

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $file_name = time() . $file->getClientOriginalName();
      $destination = public_path('/uploads/posts');
      $file->move($destination, $file_name);
      File::delete(storage_path('uploads/posts/' . $post->image));
    }


    $post->update([
      'user_id' => $user->id,
      'title' => $request->title,
      'content' => $request->content,
      'slug' => Str::slug($request->title),
      'image' => $file_name,
    ]);

    $post->categories()->sync($request->categories);
    $post->tags()->sync($request->tags);

    Alert::success('Berhasil!', 'Post berhasil diupdate!');

    return redirect()->route('admin.post.show', [$post->id, $post->slug]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->update([
      'status' => 0
    ]);

    $post->delete();

    Alert::warning('Dihapus!', 'Post berhasil dihapus! Cek di sampah.');

    return redirect()->back();
  }

  public function trash()
  {
    $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(25);

    return view('admin.post.trash', compact('posts'));
  }

  public function restore($id)
  {
    $post = Post::withTrashed()->findOrFail($id);
    $this->authorize('restore', $post);
    $post->restore();

    Alert::success('Berhasil!', 'Postingan berhasil dikembalikan dan statusnya unpublish!');
    return redirect()->back();
  }

  public function forceDelete($id)
  {
    $post = Post::withTrashed()->findOrFail($id);
    $this->authorize('forceDelete', $post);
    $post->categories()->detach();
    $post->tags()->detach();
    $post->forceDelete();

    Alert::toast('Postingan berhasil dihapus permanen', 'warning');
    return redirect()->back();
  }

  public function publish($id)
  {
    $post = Post::findOrFail($id);
    $this->authorize('publish', $post);

    $post->update([
      'status' => 1
    ]);

    Alert::success('Berhasil!', 'Postingan berhasil dipublish!');
    return redirect()->back();
  }

  public function unpublish($id)
  {
    $post = Post::findOrFail($id);
    $this->authorize('publish', $post);

    $post->update([
      'status' => 0
    ]);

    Alert::warning('Diunpublish!', 'Postingan berhasil diunpublish!');
    return redirect()->back();
  }
}
