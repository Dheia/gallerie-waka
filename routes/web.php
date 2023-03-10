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
Route::get('/page/{slug}', [\App\Http\Controllers\FrontPageController::class, 'get']);
Route::get('/tableau/{tableau}', [\App\Http\Controllers\WelcomeController::class, 'get'])->name('tableau');
Route::post('/mail', [\App\Http\Controllers\MailController::class, 'send'])->name('mail');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('bo')
    ->group(function () {
        Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
        Route::controller(\App\Http\Controllers\TableauController::class)->group(function () {
            Route::get('tableaux', 'index')->name('tableaux.index');
            Route::get('tableaux/{tableau}', 'edit')->name('tableaux.edit');
            Route::put('tableaux/{tableau}', 'update')->name('tableaux.update');
            Route::get('tableauxcreate', 'create')->name('tableaux.create');
            Route::delete('tableaux/{tableau}', 'destroy')->name('tableaux.delete');
            Route::post('tableaux', 'store')->name('tableaux.store');
            Route::put('tableaux/{tableau}/moveorder', 'moveOrder')->name('tableaux.move_order');
        });

        Route::controller(\App\Http\Controllers\TableauTagController::class)->group(function () {
            Route::get('tableautags', 'index')->name('tableautags.index');
            Route::get('tableauxTags/getAll', 'edit');
            Route::get('tableautags/{tableauTag}', 'edit')->name('tableautags.edit');
            Route::put('tableautags/{tableauTag}', 'update')->name('tableautags.update');
            Route::get('tableauxtags/create', 'create')->name('tableautags.create');
            Route::delete('tableautags/{tableauTag}', 'destroy')->name('tableautags.delete');
            Route::post('tableautags', 'store')->name('tableautags.store');
            Route::post('tableautags/neworder', 'newOrder')->name('tableaux.newOrder');
        });
        Route::controller(\App\Http\Controllers\PageController::class)->group(function () {
            Route::get('pages', 'index')->name('pages.index');
            Route::get('pages/{page}', 'edit')->name('pages.edit');
            Route::put('pages/{page}', 'update')->name('pages.update');
            Route::get('pages/create', 'create')->name('pages.create');
            Route::delete('pages/{page}', 'destroy')->name('pages.delete');
            Route::post('pages', 'store')->name('pages.store');
            Route::post('pages/neworder', 'newOrder')->name('pages.newOrder');
        });
        Route::post('upload-images', [\App\Http\Controllers\ImageController::class, 'upload']);
        Route::post('upload-images-revert', [\App\Http\Controllers\ImageController::class, 'uploadRevert']);
        Route::inertia('/createtableaux', 'Test');
        Route::inertia('/testform', 'TestForm');
    });
