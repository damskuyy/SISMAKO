<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('password.password');
    }

    public function editPw()
    {
        return view('password.change-password');
    }

    public function checkPw(Request $request)
    {
        $password = $request->input('password');

        // Mengambil URL dari request (tanpa perlu ID)
        $redirectUrl = $request->input('redirect_url', '/dashboard');

        // Cari password berdasarkan URL yang dikirim
        $pw = Password::where('url', $redirectUrl)->first();

        if ($pw && Hash::check($password, $pw->password)) {
            $request->session()->put('pin', $pw->password);

            return redirect()->intended($redirectUrl);
        }

        return back()->withErrors(['pin' => 'Invalid PIN']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil password yang tersimpan
        $pw = Password::find(1); // Ambil password dari ID 1 atau sesuai kebutuhan

        // Cek apakah current_password benar
        if (!Hash::check($request->input('current_password'), $pw->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password baru
        $pw->password = Hash::make($request->input('new_password'));
        $pw->save();

        return redirect()->route('home')->with('status', 'Password updated successfully!');
    }
}
