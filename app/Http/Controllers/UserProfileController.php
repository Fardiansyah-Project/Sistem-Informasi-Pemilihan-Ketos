<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
