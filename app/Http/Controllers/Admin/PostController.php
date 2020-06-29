<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->orderBy('created_at', 'asc')->paginate(25);

    return view('admin.post.index', compact('posts'));
  }


  public function postNonactive()
  {
    $posts = Post::where('status', 0)->with(['user', 'categories', 'tags'])->paginate(25);
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
    $post = Post::findOrFail($id);
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
    $post = Post::findOrFail($id);

    return view('admin.post.edit', compact('post'));
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Post::findOrFail($id)->delete();
    Alert::success('Berhasil!', 'Post berhasil diupload!');

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
}
