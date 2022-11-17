<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
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

	Route::get('/', function () {
		return redirect(route("projects.index"));
	})->name("index");

	Route::get('/projects', [
		ProjectController::class,
		"index"
	])->name("projects.index");

//create
	Route::get('/project/create', [
		ProjectController::class,
		"create"
	])->name("projects.create");
	Route::post('/project/create', [
		ProjectController::class,
		"store"
	])->name("projects.store");

//show
	Route::get('projects/{projectId}', [
		ProjectController::class,
		"show"
	])->name("projects.show");

//update
	Route::get('/projects/{projectId}/edit', [
		ProjectController::class,
		"edit"
	])->name("projects.edit");
	Route::put('/projects/{projectId}/edit', [
		ProjectController::class,
		"update"
	])->name("projects.update");

//delete
	Route::delete('/api/project/{projectId}/delete', [
		ProjectController::class,
		"destroy"
	])->name("projects.destroy");

	Route::resource('tickets', TicketController::class);
});
