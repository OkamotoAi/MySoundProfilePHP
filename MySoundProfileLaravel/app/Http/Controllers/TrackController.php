<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Music;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Music::all();
        return Inertia::render('Dashboard', [
            'tracks' => $tracks
        ]);
    }
}
