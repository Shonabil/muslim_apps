<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Update the authenticated user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validasi input dengan error bag khusus 'updatePassword'
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            // Update password user dengan hash
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        } catch (\Exception $e) {
            // Jika ada error, kembalikan dengan pesan error
            return back()->withErrors(['password' => 'Gagal mengubah password, silakan coba lagi.']);
        }

        // Redirect kembali dengan pesan sukses
        return back()->with('status', 'password-updated');
    }
}
