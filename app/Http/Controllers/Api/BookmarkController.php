<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surah_number' => 'required|integer',
            'ayat_number' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->user(); // Menggunakan token API (Sanctum/JWT) biasanya
        $existing = Bookmark::where('user_id', $user->id)
            ->where('surah_number', $request->surah_number)
            ->where('ayat_number', $request->ayat_number)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Bookmark berhasil dihapus.',
            ]);
        } else {
            $bookmark = Bookmark::create([
                'user_id' => $user->id,
                'surah_number' => $request->surah_number,
                'ayat_number' => $request->ayat_number,
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Bookmark berhasil ditambahkan.',
                'data' => $bookmark,
            ]);
        }
    }
    public function getBookmarks(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);
    }

    $bookmarks = Bookmark::where('user_id', $user->id)->get();

    return response()->json([
        'status' => true,
        'data' => $bookmarks,
    ]);
}

}
