<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
        if (!$this->episodeManager->hasEpisode()) {
            return redirect(route('home'));
        }

        $step = $this->episodeManager->step();
        $stepView = sprintf('step.%s', $step);

        if (View::exists($stepView)) {
            return view('ending.failed');
        }

        return view('ending.cleared');
    }
}
