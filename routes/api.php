<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test', function () {
    return [
        'name' => 'Tom',
    ];
});

Route::post('/categories', [\App\Http\Controllers\TestController::class, 'showCategory']);

Route::post('/categoryLimit', [\App\Http\Controllers\TestController::class, 'getCategoryLimit']);

Route::post('/deleteCategory', [\App\Http\Controllers\TestController::class, 'deleteCategory']);

Route::post('/findCategories', [\App\Http\Controllers\TestController::class, 'findCategories']);

Route::post('/getCount', [\App\Http\Controllers\TestController::class, 'getCount']);

Route::post('/getPeaceImages', [\App\Http\Controllers\TestController::class, 'getPeaceForCategory']);
