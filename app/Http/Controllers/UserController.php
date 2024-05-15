<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::all();
        return view('user.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('sukses', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        // if (Auth::user()->id == $id) {
        //     return redirect('user')->with('errors','User tidak dapat diedit');
        // }else{
            $request->validate([
                'name' => ['required','string','max:255'],
                'username' => ['required','string','unique:users,username,'.$id],
                'role' => 'required',
            ]);

            try{
                $user = User::find($id);
                $user->name = $request->name;
                $user->username = $request->username;
                if($request->password <> ''){
                    $user->password = Hash::make($request->password);
                }
                $user->role = $request->role;
                $user->save();
            }
            catch(\Exception $e){
                return redirect()->back()->with('errors','User Gagal Diedit');
            }
            return redirect('user')->with('sukses','User Berhasil Diedit');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->back()->with('errors','User Sedang Tidak Dapat Dihapus');
        }else{
            try{
                $user = User::find($id);
                $user->apprrovals()->delete();
                $user->pengajuans()->delete();
                $user->delete();
            }
            catch(\Exception $e){
                return redirect()->back()->with('errors','User Gagal Dihapus');
            }
            return redirect()->back()->with('sukses','User Berhasil Dihapus');
        }
    }
}
