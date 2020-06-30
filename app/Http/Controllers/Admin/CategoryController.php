<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Category::with('posts')->orderBy('name', 'asc')->paginate(25);

    return view('admin.category.index', compact('categories'));
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
      'name' => 'required|min:2|unique:categories'
    ]);

    Category::create([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);

    Alert::success('Berhasil!', 'Kategori baru berhasil ditambahkan!');
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
    $category = Category::findOrFail($id);

    if ($category->posts->count() > 0) {
      Alert::warning('Gagal', 'Kategori ini sedang diganakan oleh post!');
      return redirect()->back();
    }

    $request->validate([
      'name' => 'required|min:2|unique:categories,name,' . $id
    ]);

    $category->update([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);

    Alert::success('Berhasil!', 'Kategori berhasil diupdate!');
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
    $category = Category::findOrFail($id);

    if ($category->posts->count() > 0) {
      Alert::warning('Gagal hapus!', 'Kategori ini sedang diganakan oleh post!');
      return redirect()->back();
    }

    $category->delete();

    Alert::warning('Dihapus!', 'Kategori berhasil dihapus. Cek di sampah!');
    return redirect()->back();
  }

  public function trash()
  {
    $categories = Category::onlyTrashed()->paginate(25);

    return view('admin.category.trash', compact('categories'));
  }

  public function forceDelete($id)
  {
    Category::onlyTrashed()->findOrFail($id)->forceDelete();

    Alert::warning('Dihapus!', 'Kategori berhasil dihapus permanen!');
    return redirect()->back();
  }

  public function restore($id)
  {
    Category::withTrashed()->findOrFail($id)->restore();
    Alert::success('Berhasil!', 'Kategori berhasil dikembalikan!');
    return redirect()->back();
  }
}
