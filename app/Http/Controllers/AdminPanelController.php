<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminPanelController extends Controller
{
    public function index()
    {   
        $users=User::get();
        // dd('Admin Panel Accessed');
        return view('pages.admin_panel',compact('users'));
    }
    public function updateRole(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|string|in:admin,super_admin,user',
    ]);

    $user = User::findOrFail($request->user_id);
    $user->role = $request->role;
    $user->save();

    return response()->json(['message' => 'Role updated successfully!']);
}

}
