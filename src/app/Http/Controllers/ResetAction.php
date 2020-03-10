<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class ResetAction extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->remove('episode');
        return redirect(route('home'));
    }
}
