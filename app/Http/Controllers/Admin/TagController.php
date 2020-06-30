<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class TagController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tags = Tag::with('posts')->orderBy('name', 'asc')->paginate(25);

    return view('admin.tag.index', compact('tags'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|min:2|unique:tags'
    ]);

    Tag::create([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);

    Alert::success('Berhasil!', 'Berhasil membuat tag baru!');
    return redirect()->back();
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
    $tag = Tag::findOrFail($id);

    if ($tag->posts->count() > 0) {
      Alert::warning('Gagal!', 'Tag ini masih digunakan oleh post!');
      return redirect()->back();
    }

    $request->validate([
      'name' => 'required|min:2|unique:tags,name,' . $tag->id
    ]);

    $tag->update([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);

    Alert::success('Berhasil!', 'Tag berhasil diupdate!');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $tag = Tag::findOrFail($id);

    if ($tag->posts->count() > 0) {
      Alert::warning('Gagal!', 'Tag ini masih digunakan oleh post!');
      return redirect()->back();
    }

    $tag->delete();
    Alert::warning('Dihapus!', 'Tag berhasil dihapus. Cek di sampah!');
    return redirect()->back();
  }

  public function trash()
  {
    $tags = Tag::onlyTrashed()->orderBy('name', 'asc')->paginate(25);

    return view('admin.tag.trash', compact('tags'));
  }

  public function restore($id)
  {
    Tag::onlyTrashed()->findOrFail($id)->restore();

    Alert::success('Berhasil!', 'Tag berhasil dikembalikan dari sampah!');

    return redirect()->back();
  }

  public function forceDelete($id)
  {
    Tag::onlyTrashed()->findOrFail($id)->forceDelete();

    Alert::warning('Dihapus!', 'Tag berhasil dihapus permanen!');

    return redirect()->back();
  }
}
