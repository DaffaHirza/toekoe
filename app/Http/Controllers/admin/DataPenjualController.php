<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SellerApproved;
use App\Mail\SellerRejected;

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
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $seller = User::findOrFail($id);
        $oldStatus = $seller->status;
        
        $seller->status = $validated['status'];
        
        // Update rejection reason if status is rejected
        if ($validated['status'] === 'rejected') {
            $seller->rejection_reason = $validated['rejection_reason'] ?? null;
        } else {
            $seller->rejection_reason = null; // Clear rejection reason if approved
        }
        
        $seller->save();

        // Send email notification only if status actually changed
        if ($oldStatus !== $seller->status) {
            try {
                if ($seller->status === 'approved') {
                    Mail::to($seller->email)->send(new SellerApproved($seller));
                } elseif ($seller->status === 'rejected') {
                    Mail::to($seller->email)->send(new SellerRejected($seller, $seller->rejection_reason));
                }
            } catch (\Exception $e) {
                // Log error but don't fail the status update
                \Log::error('Failed to send email notification: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui dan email notifikasi telah dikirim!');
    }
}
