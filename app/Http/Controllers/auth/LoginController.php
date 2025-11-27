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
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.beranda');
            }

            if ($user->role === 'seller') {
                // Cek status approval untuk seller
                if ($user->status === 'pending') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun Anda masih menunggu persetujuan admin.'
                    ])->withInput();
                }

                if ($user->status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun Anda ditolak. Alasan: ' . ($user->rejection_reason ?? 'Tidak disebutkan')
                    ])->withInput();
                }

                return redirect()->route('seller.beranda');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
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
