<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20|unique:users,phone',
            'password'   => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'is_admin'   => 'no',
            'role'       => 0,
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin account created successfully!');
    }

    public function login(Request $request)
    {

        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        if ($user->is_admin !== 'yes') {
            return back()->withErrors(['email' => 'Access denied. Only admins can log in here.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::login($user);
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $user->first_name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }


    public function UserList()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully.');
    }
}
