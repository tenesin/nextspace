<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\Nextspace;
use App\Models\Favorite;

class NextspaceController extends Controller
{
    /**
     * Display a listing of the nextspaces.
     */
    public function index()
    {
        // Mengambil data Nextspace terbaru, 4 per halaman
        $nextspaces = Nextspace::latest()->paginate(6);

        return view('dashboard', compact('nextspaces'));
    }

    /**
     * Display the specified Nextspace with details.
     */
    public function show($id)
    {
        // Ambil nextspace beserta relasinya
        $nextspace = Nextspace::with(['amenities', 'services', 'timeSlots', 'reviews.user'])->findOrFail($id);

        // Cek apakah nextspace ini sudah difavoritkan oleh user yang sedang login
        $isFavorited = false;
        if (Auth::check()) {
            $isFavorited = Favorite::where('user_id', Auth::id())
                ->where('nextspace_id', $nextspace->id)
                ->exists();
        }

        return view('nextspaces.show', compact('nextspace', 'isFavorited'));
    }
}
