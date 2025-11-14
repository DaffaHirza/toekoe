<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::user()->role == 'seller' && Auth::user()->status == 'suspended') {
            Auth::logout();
            return back()->withErrors(['Akun Anda sedang disuspend.']);
        }


        $user = User::where('email', $credentials['email'])->first();

        // Jika email tidak ditemukan
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Cek password benar?
        if (!Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Cek status user
        if ($user->status === 'pending') {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda masih menunggu persetujuan admin.'],
            ]);
        }

        if ($user->status === 'rejected') {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda ditolak. Alasan: ' . $user->rejection_reason],
            ]);
        }

        if ($user->status === 'suspend') {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda telah disuspend. Hubungi admin.'],
            ]);
        }

        if ($user->role !== 'admin' && $user->status !== 'approved') {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda tidak aktif.'],
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role === 'seller') {
            return redirect()->intended('/penjual/beranda');
        }

        return redirect()->intended('/admin/beranda');
    }


    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
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
