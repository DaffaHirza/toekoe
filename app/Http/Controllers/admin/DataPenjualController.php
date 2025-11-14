<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataPenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // All sellers
        // $sellers = User::where('role', 'seller')->get();

        // $pending = User::where('role', 'seller')
        //     ->where('status', 'pending')
        //     ->get();

        // $approved = User::where('role', 'seller')
        //     ->where('status', 'approved')
        //     ->get();

        // return view('admin.pages.datapenjual.view', compact('sellers', 'pending', 'approved'));

        $user = User::all();
        return view('admin.pages.datapenjual.view', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function updateStatus(Request $request, $id)
    {
        $seller = User::findOrFail($id);
        $seller->status = $request->status;
        $seller->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
