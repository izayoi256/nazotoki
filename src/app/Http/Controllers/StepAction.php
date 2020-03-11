<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

final class StepAction extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function __invoke(Request $request, int $step)
    {
        $view = sprintf('step.%d', $step);

        if (!View::exists($view)) {
            return redirect(route('ending'));
        }

        return view($view, [
            'step' => $step,
            'expiresIn' => $this->episodeManager->expiresIn(),
        ]);
    }
}
