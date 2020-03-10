<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class StartAction extends Controller
{
    public function __invoke(Request $request)
    {
        $episode = $request->session()->get('episode', [
            'expiresAt' => new \DateTimeImmutable(sprintf('+%d seconds', config('app.episode_expires_in'))),
            'progress' => 1,
        ]);
        $request->session()->put('episode', $episode);
        return redirect(route('step', ['step' => 1]));
    }
}
