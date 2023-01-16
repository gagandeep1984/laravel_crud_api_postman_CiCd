<?php

use App\Http\Controllers\API\StudentController;
use App\Models\Student;
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


// Route::group("/students", function () {
//     Route::get("/", [StudentController::class, 'index']);
//     Route::post("/", [StudentController::class, 'store']);
// });

Route::get("/students", [StudentController::class, 'index']);
Route::post("/student", [StudentController::class, 'store']);
Route::put("/student/{id}/update", [StudentController::class, 'update']);
Route::get("/student/{id}", [StudentController::class, 'show']);
Route::delete("/student/{id}", [StudentController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
