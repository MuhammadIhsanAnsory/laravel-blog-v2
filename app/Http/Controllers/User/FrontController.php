<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index()
  {
    $posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->orderBy('created_at', 'desc')->paginate(5);
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();

    return view('front.post.index', compact('posts', 'categories', 'tags'));
  }

  public function show($id)
  {
    $post = Post::where('status', 1)->with(['user', 'categories', 'tags'])->findOrFail($id);
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();

    return view('front.post.show', compact('post', 'categories', 'tags'));
  }

  public function tag($slug)
  {
    $tag = Tag::with(['posts'])->where('slug', $slug)->get()->first();
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    // dd($tag);
    return view('front.post.list', compact('tag', 'categories', 'tags'));
  }
}
