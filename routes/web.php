<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProjectController::class, "index"]);

//create
Route::get('/project/create', [ProjectController::class, "create"]);
Route::post('/project/create', [ProjectController::class, "store"]);

//show
Route::get('projects/{projectId}', [ProjectController::class, "show"]);

//update
Route::get('/projects/{projectId}/edit', [ProjectController::class, "edit"]);
Route::put('/projects/{projectId}/edit', [ProjectController::class, "update"]);

//delete
Route::delete('/project/{projectId}/delete', [ProjectController::class, "destroy"]);
