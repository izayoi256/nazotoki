<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

final class StepMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $episode = $request->session()->get('episode');

        if ($episode === null) {
            return redirect(route('home'));
        }

        $now = new \DateTimeImmutable();
        $expiresAt = $episode['expiresAt'] ?? $now;
        if ($expiresAt <= $now) {
            return redirect(route('ending'));
        }

        $progress = $episode['progress'] ?? 0;
        $step = $request->route()->parameter('step') ?? 1;

        if (($progress & (1 << ($step - 1))) === 0) {
            return redirect(route('step', ['step' => $step - 1]));
        }

        if ($progress >= (1 << $step)) {
            return redirect(route('step', ['step' => $step + 1]));
        }

        return $next($request);
    }
}
