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

Route::get("/students", [StudentController::class, 'index']);       // 'StudentController@index' 
Route::post("/student", [StudentController::class, 'store']);
Route::put("/student/{id}/update", [StudentController::class, 'update']);
Route::get("/student/{id}", [StudentController::class, 'show']);
Route::delete("/student/{id}", [StudentController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// https://github.com/fisayoafolayan/e-commerce-laravel-vue
// Route::post('login', 'UserController@login');
// Route::post('register', 'UserController@register');
// Route::get('/products', 'ProductController@index');
// Route::post('/upload-file', 'ProductController@uploadFile');
// Route::get('/products/{product}', 'ProductController@show');
// Route::group(['middleware' => 'auth:api'], function () {
//     Route::get('/users', 'UserController@index');
//     Route::get('users/{user}', 'UserController@show');
//     Route::patch('users/{user}', 'UserController@update');
//     Route::get('users/{user}/orders', 'UserController@showOrders');
//     Route::patch('products/{product}/units/add', 'ProductController@updateUnits');
//     Route::patch('orders/{order}/deliver', 'OrderController@deliverOrder');
//     Route::resource('/orders', 'OrderController');
//     Route::resource('/products', 'ProductController')->except(['index', 'show']);
// });
