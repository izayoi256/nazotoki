<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;

final class EndingAction extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function __invoke(Request $request)
    {
        $step = $this->episodeManager->step();

        if ($step === null || $step < 4) {
            return view('ending.failed');
        }

        return view('ending.cleared');
    }
}
