<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;

final class StartAction extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function __invoke(Request $request)
    {
        if ($this->episodeManager->episode() === null) {
            $this->episodeManager->newEpisode();
        }
        return redirect(route('step', ['step' => $this->episodeManager->step()]));
    }
}
