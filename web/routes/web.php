<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'     => 'posts',
    'controller' => PostController::class
], function ($router) {
    Route::get('/', 'index');
});

Route::group([
    'prefix'     => 'products',
    'controller' => ProductController::class
], function($router) {
    Route::get('multi-filter', 'multiFilter');
    Route::get('multi-pipeline', 'multiPipeline');
    Route::get('subscribe-list', 'subscribeList')->middleware([
        'auth',
        'features:course-management'
    ]);
    Route::get('api-custom-paginate', 'apiCustomPaginate');
});

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware([
        'auth',
        'verified'
    ])
    ->name('home');