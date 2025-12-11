<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:500',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'nama_kelurahan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:users',
            'foto' => 'required|image|max:2048',
            'foto_ktp' => 'required|image|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $fotoPath = $request->file('foto')->store('users/photos', 'public');
        $fotoKtpPath = $request->file('foto_ktp')->store('private_docs/ktp', 'local');

        $user = User::create([
            'nama_toko' => $request->nama_toko,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nama_kelurahan' => $request->nama_kelurahan,
            'kabupaten_kota' => $request->kabupaten_kota,
            'provinsi' => $request->provinsi,
            'no_ktp' => $request->no_ktp,
            'foto' => $fotoPath,
            'foto_ktp' => $fotoKtpPath,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'status' => 'pending',
        ]);

        Auth::logout();

        return redirect('/login')->with('status', 'Pendaftaran berhasil! Akun Anda telah dibuat dan sedang menunggu persetujuan admin.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
