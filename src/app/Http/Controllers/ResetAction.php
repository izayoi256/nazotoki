<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;

final class ResetAction extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function __invoke(Request $request)
    {
        $this->episodeManager->clearEpisode();
        return redirect(route('home'));
    }
}
