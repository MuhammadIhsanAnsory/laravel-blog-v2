<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::orderBy('name', 'ASC')->paginate(5);
    return view('admin.user.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd($request);
    $request->validate([
      'name' => 'required|min:2',
      'email' => 'required|email|unique:users',
      'image' => 'image|mimes:png,jpeg,jpg',
      'role' => 'required|in:admin,writer,user',
    ]);

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $file_name = time() . $file->getClientOriginalName();
      $destination = public_path('/uploads/users/');
      $file->move($destination, $file_name);

      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt('password'),
        'image' => $file_name,
        'role' => $request->role,
      ]);
    } else {
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt('password'),
        'role' => $request->role,
      ]);
    }

    Alert::success('Berhasil!', 'Berhasil menambahkan user baru!');
    return redirect()->route('admin.user.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::withTrashed()->findOrFail($id);
    return view('admin.user.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::withTrashed()->findOrFail($id);
    return view('admin.user.edit', compact('user'));
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
    $user = User::withTrashed()->findOrFail($id);

    $request->validate([
      'name' => 'required|min:2',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'image' => 'image|mimes:png,jpeg,jpg',
      'role' => 'required|in:admin,writer,user',
    ]);

    $file_name = $user->image;

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $file_name = time() . $file->getClientOriginalName();
      $destination = public_path('/uploads/users');
      $file->move($destination, $file_name);
      File::delete(storage_path('uploads/users/' . $user->image));
    }

    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'image' => $file_name,
      'role' => $request->role,
    ]);

    Alert::success('Berhasil!', 'Data user berhasil diupdate!');

    return redirect()->route('admin.user.show', $user->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::findOrFail($id)->delete();

    Alert::warning('Berhasil dinonaktifkan!', 'User telah dinonaktifkan!');

    return redirect()->back();
  }

  public function trash()
  {
    $users = User::onlyTrashed()->paginate(5);

    return view('admin.user.trash', compact('users'));
  }

  public function restore($id)
  {
    User::withTrashed()->find($id)->restore();

    Alert::success('Berhasil diaktifkan!', 'User berhasil diaktifkan!');

    return redirect()->back();
  }



  public function burn($id)
  {
    User::withTrashed()->findOrFail($id)->forceDelete();

    Alert::warning('Dihapus!', 'User telah dihapus!');

    return redirect()->back();
  }
}
