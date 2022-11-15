<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/logout', [
	LoginController::class,
	"logout"
]);

Route::middleware(["auth"])->group(function () {

	Route::get('/', [
		ProjectController::class,
		"index"
	])->name("index");

	Route::get('/home', [
		ProjectController::class,
		"index"
	])->name("index");

//create
	Route::get('/project/create', [
		ProjectController::class,
		"create"
	])->name("project.create");
	Route::post('/project/create', [
		ProjectController::class,
		"store"
	])->name("project.store");

//show
	Route::get('projects/{projectId}', [
		ProjectController::class,
		"show"
	])->name("project.show");

//update
	Route::get('/projects/{projectId}/edit', [
		ProjectController::class,
		"edit"
	])->name("project.edit");
	Route::put('/projects/{projectId}/edit', [
		ProjectController::class,
		"update"
	])->name("project.update");

//delete
	Route::delete('/api/project/{projectId}/delete', [
		ProjectController::class,
		"destroy"
	])->name("project.destroy");
});
