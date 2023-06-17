<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('/users',UserController::class);
Route::post('/auth/login',[AuthController::class,'logIn']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/auth/logout',[AuthController::class, 'logOut']);

    Route::put('/tasks/assign/{task}',[TaskController::class, 'assingTaskToDeveloper']);
    Route::put('/tasks/update/state/{task}',[TaskController::class, 'updateTaskState']);
    
    Route::apiResource('/customers',CustomerController::class);
    Route::apiResource('/projects',ProjectController::class);
    Route::apiResource('/tasks',TaskController::class);
});

