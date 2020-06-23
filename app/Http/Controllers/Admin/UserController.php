<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Alert;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::orderBy('name', 'ASC')->paginate(25);
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
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
    //
  }
}
