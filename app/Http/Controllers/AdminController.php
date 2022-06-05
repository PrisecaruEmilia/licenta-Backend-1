<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AdminController extends Controller
{
    public function AdminLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {

        $adminData = User::find(1);
        return view('backend.admin.admin_profile', compact('adminData'));
    } // end mehtod

    public function UserProfileStore(Request $request)
    {
    }
}
