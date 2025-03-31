<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php'; /* All endpoints are '/rpi' as RESTful Api */

Route::middleware('auth:api')->group(function (){
    Route::post('/auth/token', UserController::class)->name('auth.token');

});
