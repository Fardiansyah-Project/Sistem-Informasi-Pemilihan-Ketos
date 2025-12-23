<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function admin()
    {
        $admin = User::where('id', '!=', Auth::user()->id)
            ->where('role', 'admin')
            ->paginate(10);
        return view('admin.userManagement.admin', compact('admin'));
    }

    public function voters()
    {
        $voters = User::where('role', 'voter')->paginate(10);
        return view('admin.userManagement.voter', compact('voters'));
    }

    public function create()
    {
        return view('admin.userManagement.createAdmin');
    }

    public function createVoter()
    {
        return view('admin.userManagement.createVoter');
    }

    public function register()
    {
        return view('voting.register');
    }

    public function storeAdmin(Request $request)
    {
        $generatePassword = Str::random(5) . date('y-m');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($generatePassword),
            'role' => $request->role,
        ]);

        session()->flash('generate_password', $generatePassword);

        return redirect()->route('user-management.admin')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function storeVoter(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nis' => 'required|string|max:10|min:10|unique:users',
        ], [
            'nis.required' => 'NIS wajib diisi',
            'nis.max' => 'NIS maksimal 10 karakter',
            'nis.min' => 'NIS minimal 10 karakter',
            'nis.unique' => 'NIS sudah terdaftar',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('voter.register')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function generatePassword(Request $request, $id)
    {
        $generatePassword = Str::random(5) . date(now('d'));
        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($generatePassword),
        ]);

        if ($user->role != 'admin') {
            return redirect()->route('user-management.voters')->with('generate_password', $generatePassword);
        }

        return redirect()->route('user-management.admin')->with('generate_password', $generatePassword);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.userManagement.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $generatePassword = Str::random(5) . date(now('d'));
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        session()->flash('generate_password', $generatePassword);

        return redirect()->route('user-management.admin')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user->role != 'admin') {
            return redirect()->route('user-management.voters')->with('success', 'User berhasil dihapus!');
        }
        return redirect()->route('user-management.admin')->with('success', 'User berhasil dihapus!');
    }
}
