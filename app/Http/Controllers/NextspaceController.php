<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nextspace;
use App\Models\TimeSlot; // Import TimeSlot model

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = NextSpace::latest()->paginate(4); // 6 item per halaman, bisa kamu sesuaikan
        return view('/dashboard', compact('nextspaces'));
    }

    public function show($id)
{
    $nextspace = Nextspace::with(['amenities', 'services', 'timeSlots'])->findOrFail($id);
    return view('nextspaces.show', compact('nextspace'));
}
}
