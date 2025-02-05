<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);
Route::patch('/todos/{todo}', [TodoController::class, 'update']);
// パラメータで渡すか　パスで渡すか
// Route::patch('/todos/update', [TodoController::class, 'update']);
// put リソース全てを置き換える
// patch リソース一部を更新 
// Route::delete('/todos/delete', [TodoController::class, 'destroy']);
Route::delete('/todos', [TodoController::class, 'destroy']);

// REST設計 RESTfull

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
