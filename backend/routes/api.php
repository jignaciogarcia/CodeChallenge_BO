<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user', [UserController::class,'getLoggedUserInfo']);
    Route::post('/logout', [UserController::class,'logout']);
    Route::get('/contacts', [ContactController::class,'getUserContacts']);
    Route::post('/contacts', [ContactController::class,'create']);
    Route::put('/contacts/{contactId}', [ContactController::class,'update']);
});
