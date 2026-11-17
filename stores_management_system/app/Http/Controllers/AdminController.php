<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:admins',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:Admin,Manager,User,Stock Keeper,Technician,Management Assistance',
    ]);

    $admin = Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    // Log the user in automatically
    auth()->guard('admin')->login($admin);
    return redirect()->route('admin.dashboard')->with('status', 'Registration successful! Welcome!');
}

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // Redirect to admin.dashboard after login
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function index()
    {
        $users = Admin::all();
        return view('admin.auth.index', compact('users'));
    }

    public function destroy($id)
    {
        if (auth('admin')->user()->role !== 'Admin') {
            return redirect()->route('admin.index')->with('error', 'Only Admins can delete users!');
        }

        $user = Admin::findOrFail($id);

        if ($user->id === auth('admin')->id()) {
            return redirect()->route('admin.index')->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        return redirect()->route('admin.index')->with('status', 'User deleted successfully!');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}