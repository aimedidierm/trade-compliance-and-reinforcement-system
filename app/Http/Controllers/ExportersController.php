<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;

class ExportersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', UserRole::EXPORTER->value)->paginate(10);
        return view('minicom.exporters-management', compact('users'));
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session(['success' => 'User deleted successfully.']);
            return redirect('/minicom/users');
        } else {
            return redirect('/minicom/users')->withErrors('User not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function reject(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = UserStatus::REJECTED->value;
            $user->update();
            session(['success' => 'User reject successfully.']);
            return redirect('/minicom/users');
        } else {
            return redirect('/minicom/users')->withErrors('User not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function approve(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = UserStatus::APPROVED->value;
            $user->update();
            session(['success' => 'User approved successfully.']);
            return redirect('/minicom/users');
        } else {
            return redirect('/minicom/users')->withErrors('User not found');
        }
    }
}
