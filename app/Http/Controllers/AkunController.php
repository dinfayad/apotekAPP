<?php

namespace App\Http\Controllers;

use App\Models\akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = akun::all();
        return view('user.akun', compact('akun'));
        //
    }

    public function landing()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.pengguna');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:akuns,email',
            'password'  => 'required|min:1',
            'role' =>  'required',
        ]);

        akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success' , 'berhasil menambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(akun $akzun, $id)
    {
        $akun = akun::findOrFail($id);

        return view('user.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([    
            'name' => 'required',
            'email' => 'required|email|unique:akuns,email',
            'password'  => 'required|min:1',
            'role' =>  'required',
        ]);

        akun::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        akun::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
    }

    public function login() {
        return view('user.login');
    }

    public function loginAuth(Request  $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect()->route('home');
        } else  {
            return redirect()->back()->with('failed', 'proses login gagal');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'anda telah logout');
    }

}

    