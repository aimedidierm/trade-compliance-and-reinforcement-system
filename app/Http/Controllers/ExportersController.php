<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/minicom/users')->with('success', 'User deleted successfully.');
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
            return redirect('/minicom/users')->with('success', 'User rejected successfully.');
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
            return redirect('/minicom/users')->with('success', 'User approved successfully.');
        } else {
            return redirect('/minicom/users')->withErrors('User not found');
        }
    }
}
