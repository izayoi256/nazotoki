<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class AnswerStepAction extends Controller
{
    public function __invoke(Request $request, int $step)
    {
        $request->validate($this->rule($step));

        $episode = $request->session()->get('episode');
        $progress = $episode['progress'] ?? 0;
        $episode['progress'] = $progress | (1 << $step);
        $request->session()->put('episode', $episode);

        return redirect(route('step', ['step' => $step + 1]));
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
