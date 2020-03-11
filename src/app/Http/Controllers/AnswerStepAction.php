<?php

namespace App\Http\Controllers;

use App\Core\EpisodeManager;
use Illuminate\Http\Request;

final class AnswerStepAction extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    public function __invoke(Request $request, int $step)
    {
        $request->validate($this->rule($step));

        $this->episodeManager->passStep($step);

        return redirect(route('step', ['step' => $this->episodeManager->step()]));
    }

    private function rule(int $step): array
    {
        return [
            1 => [
                'q1' => [
                    'required',
                    'string',
                    'in:hoge',
                ],
                'q2' => [
                    'required',
                    'string',
                    'in:fuga',
                ],
            ],
            2 => [
                'q1' => [
                    'required',
                    'string',
                    'in:piyo',
                ],
                'q2' => [
                    'required',
                    'string',
                    'in:foo',
                ],
            ],
            3 => [
                'q1' => [
                    'required',
                    'string',
                    'in:bar',
                ],
                'q2' => [
                    'required',
                    'string',
                    'in:baz',
                ],
            ],
        ][$step];
    }
}
