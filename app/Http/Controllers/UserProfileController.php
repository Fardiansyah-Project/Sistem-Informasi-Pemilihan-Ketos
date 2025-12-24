<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.userProfile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('user-profile.edit', $user->id)->with('success', 'Berhasil menyimpan perubahan.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.userProfile.show', compact('user'));
    }

    public function updatePassword()
    {
        return view('admin.userProfile.updatePassword');
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        
         $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'string', Password::min(8)->numbers(), 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini tidak boleh kosong.',
            'new_password.required' => 'Kata sandi baru tidak boleh kosong.',
            'new_password.string' => 'Kata sandi baru harus berupa string.',
            'new_password.min' => 'Kata sandi baru harus minimal 8 karakter.',
            // 'new_password.mixedCase' => 'Kata sandi baru harus mengandung huruf besar dan kecil.',
            'new_password.numbers' => 'Kata sandi baru harus mengandung angka.',
            // 'new_password.symbols' => 'Kata sandi baru harus mengandung simbol.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->route('user-profile.update-password', $user->id)->with('success', 'Berhasil mengubah password.');
    }
}
