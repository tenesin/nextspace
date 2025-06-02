<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nextspace;

class NextspaceController extends Controller
{
    public function index()
    {
        $nextspaces = Nextspace::with(['amenities', 'services'])->get();
        return view('dashboard', compact('nextspaces'));
    }

    public function show($id)
    {
        $nextspace = Nextspace::with(['amenities', 'services'])->findOrFail($id);

        if (is_string($nextspace->time_slots)) {
            $nextspace->time_slots = json_decode($nextspace->time_slots, true);
        }
        $nextspace->time_slots = is_array($nextspace->time_slots) ? $nextspace->time_slots : [];

        return view('nextspaces.show', compact('nextspace', 'id'));
    }
}
