<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.userlist.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.userlist.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
    
        User::create($request->all());
     
        return redirect()->route('userlist.index')->with('success','Berhasil Menyimpan !');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.userlist.edit',compact('user'));
    }

    public function update(Request $request, User $user, $id)
    {
        $validateData=$request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $validateData['password']=bcrypt($validateData['password']); 
        $user=User::findOrFail($id);  
        $user->update($validateData);
    
        return redirect()->route('userlist.index')->with('success','Berhasil Update !');
    }

    public function destroy(User $user, $id)
    {
        $user =  User::find($id);
        $user->delete();
        return redirect()->route('userlist.index')->with('success','Berhasil Hapus !');
    }
}