<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function Profile()
    {
        $user = Auth::user();
        return view('pages.user-account.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        if (Auth::id() !== (int) $id) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขข้อมูลนี้');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = $request->only('name', 'email', 'phone');

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }
}
