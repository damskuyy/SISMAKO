<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'redirectUrl' => 'required|string',
        ]);

        $passwordRecord = Password::first();

        // Jika tidak ada record, buat record dengan password default
        if (!$passwordRecord) {
            $passwordRecord = Password::create([
                'password' => bcrypt('12345'), // Default password
            ]);
        }

        if (Hash::check($request->password, $passwordRecord->password)) {
            // Set session 'password_verified' menjadi true jika password benar
            session(['password_verified' => true]);
            return redirect($request->redirectUrl);
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $passwordRecord = Password::first();
        if ($passwordRecord) {
            $passwordRecord->update([
                'password' => bcrypt($request->password),
            ]);
        } else {
            Password::create([
                'password' => bcrypt($request->password),
            ]);
        }

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
