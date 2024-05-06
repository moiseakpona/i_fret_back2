<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/who',[AuthController::class,'who']);
});

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/checkPhoneNumber', [AuthController::class, 'checkPhoneNumber']);
Route::post('/savetoken',  [AuthController::class, 'saveToken']);


Route::post('/verifyotp', [AuthController::class,'verifyOtp']);



Route::middleware('auth:api')->group(function () {
    Route::put('/update_user_api', [UserController::class, 'update']);

    // Endpoint pour récupérer les informations de l'utilisateur connecté
    Route::get('/utilisateur', [UserController::class, 'getUtilisateur']);
});

