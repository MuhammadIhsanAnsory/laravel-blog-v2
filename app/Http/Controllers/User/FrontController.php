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
    $posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->latest()->limit(5)->get();
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    $random_posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->inRandomOrder()->limit(5)->get();


    return view('front.post.index', compact('posts', 'categories', 'tags', 'random_posts'));
  }

  public function show($id)
  {
    $post = Post::where('status', 1)->with(['user', 'categories', 'tags'])->findOrFail($id);
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    $random_posts = Post::where('status', 1)->inRandomOrder()->limit(5)->get();
    $related_posts = Post::where('status', 1)->inRandomOrder()->limit(3)->get();

    // dd($related_posts);
    // $related_posts = Post::where('title', 'like', '%' . $post->title . '%')->where('id', '!=', $post->id)->limit(3)->get();

    return view('front.post.show', compact('post', 'categories', 'tags', 'random_posts', 'related_posts'));
  }

  public function tag_list($slug)
  {
    $tag = Tag::with(['posts'])->where('slug', $slug)->get()->first();
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    $random_posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->inRandomOrder()->limit(5)->get();
    return view('front.post.tag_list', compact('tag', 'categories', 'tags', 'random_posts'));
  }

  public function category_list($slug)
  {
    $category = Category::with(['posts'])->where('slug', $slug)->get()->first();
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    $random_posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->inRandomOrder()->limit(5)->get();

    return view('front.post.category_list', compact('category', 'categories', 'tags', 'random_posts'));
  }

  public function latest()
  {
    $posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->latest()->paginate(10);
    $categories = Category::with('posts')->orderBy('name', 'asc')->get();
    $tags = Tag::with('posts')->orderBy('name', 'asc')->get();
    $random_posts = Post::where('status', 1)->with(['user', 'categories', 'tags'])->inRandomOrder()->limit(5)->get();


    return view('front.post.latest', compact('posts', 'categories', 'tags', 'random_posts'));
  }
}
