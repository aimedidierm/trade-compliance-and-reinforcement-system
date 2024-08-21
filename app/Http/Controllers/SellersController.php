<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', UserRole::SELLER->value)->paginate(10);
        return view('minicom.sellers-management', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/minicom/users/sellers')->with('success', 'User deleted successfully.');
        } else {
            return redirect('/minicom/users/sellers')->withErrors('User not found');
        }
    }
}
