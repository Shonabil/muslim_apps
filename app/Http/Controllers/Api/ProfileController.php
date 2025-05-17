<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Mendapatkan data profile user yang sedang login
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Update profile user yang sedang login
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            // tambahkan validasi lain jika perlu
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profile berhasil diperbarui',
            'user' => $user,
        ]);
    }
}
