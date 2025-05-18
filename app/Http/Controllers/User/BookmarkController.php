<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    // Toggle bookmark on/off
    public function toggle(Request $request)
    {
        $request->validate([
            'surah' => 'required|integer|min:1|max:114',
            'ayat' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $surah = $request->input('surah');
        $ayat = $request->input('ayat');

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('surah', $surah)
            ->where('ayat', $ayat)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'surah' => $surah,
                'ayat' => $ayat,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    // Optional: List bookmarks for current user
    public function list(Request $request)
    {
        $user = $request->user();
        $bookmarks = Bookmark::where('user_id', $user->id)->get();

        return response()->json($bookmarks);
    }
}
