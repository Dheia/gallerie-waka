<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/pages/{slug}', [\App\Http\Controllers\PageController::class, 'get']);
Route::get('/tableau/{tableau}', [\App\Http\Controllers\WelcomeController::class, 'get'])->name('tableau');
Route::post('/mail', [\App\Http\Controllers\MailController::class, 'send'])->name('mail');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->prefix('bo')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        //
        Route::get('tableaux', [\App\Http\Controllers\TableauController::class, 'index'])
        ->name('tableaux.index');

        Route::put('tableaux/{tableau}', [\App\Http\Controllers\TableauController::class, 'update']);
        Route::put('tableaux/{tableau}/moveorder', [\App\Http\Controllers\TableauController::class, 'moveOrder']);
        

        Route::delete('tableaux/{tableau}', [\App\Http\Controllers\TableauController::class, 'destroy']);

        Route::post('tableaux', [\App\Http\Controllers\TableauController::class, 'create']);

        Route::post('upload-images', [\App\Http\Controllers\ImageController::class, 'upload']);
        Route::post('upload-images-revert', [\App\Http\Controllers\ImageController::class, 'uploadRevert']);

        Route::get('tableauTags', [\App\Http\Controllers\TableauTagController::class, 'index'])
        ->name('tags.index');

        Route::get('tableauxTags/getall', [\App\Http\Controllers\TableauTagController::class, 'getAll']);
        Route::post('tableauxTags', [\App\Http\Controllers\TableauTagController::class, 'newOrder']);

        Route::get('pages', [\App\Http\Controllers\PageController::class, 'index'])
        ->name('pages.index');
        Route::put('pages/{page}', [\App\Http\Controllers\PageController::class, 'update']);

        Route::inertia('/test', 'Test');
        Route::inertia('/testform', 'TestForm');
    });
