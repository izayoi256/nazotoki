<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class StepAction extends Controller
{
    public function __invoke(Request $request, int $step)
    {
        $episode = $request->session()->get('episode');
        $now = new \DateTimeImmutable();
        $expiresAt = $episode['expiresAt'] ?? $now;

        return view(sprintf('step.%d', $step), [
            'step' => $step,
            'expiresIn' => $expiresAt->getTimestamp() - $now->getTimestamp(),
        ]);
    }
}
