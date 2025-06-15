<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($nextspaceId)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('nextspace_id', $nextspaceId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favorites.';
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'nextspace_id' => $nextspaceId,
            ]);
            $message = 'Added to favorites!';
        }

        return back()->with('status', $message);
    }

        public function index()
    {
        $favorites = Favorite::with('nextspace')
            ->where('user_id', Auth::id())
            ->get();
        return view('favorites.index', compact('favorites'));
    }
 }