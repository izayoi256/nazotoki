<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class EndingAction extends Controller
{
    public function __invoke(Request $request)
    {
        $episode = $request->session()->get('episode');
        $progress = $episode['progress'] ?? 0;

        if ($progress < 0b1111) {
            return view('ending.failed');
        }

        return view('ending.cleared');
    }
}
