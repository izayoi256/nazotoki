<?php

namespace App\Http\Middleware;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;

final class StepMiddleware
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function handle(Request $request, \Closure $next)
    {
        if (!$this->episodeManager->hasEpisode()) {
            return redirect(route('home'));
        }

        if ($this->episodeManager->expired()) {
            return redirect(route('ending'));
        }

        $step = (int)($request->route()->parameter('step') ?? 1);
        $currentStep = $this->episodeManager->step();

        if ($step !== $currentStep) {
            return redirect(route('step', ['step' => $currentStep]));
        }

        return $next($request);
    }
}
