<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::post('/start', Controllers\StartAction::class)->name('start');
Route::post('/reset', Controllers\ResetAction::class)->name('reset');

Route::redirect('/step/4', '/ending');

Route::middleware('step')->group(static function () {
    Route::get('/step/{step}', Controllers\StepAction::class)->name('step');
    Route::post('/step/{step}', Controllers\AnswerStepAction::class)->name('step.answer');
});

Route::get('/ending', Controllers\EndingAction::class)->name('ending');
