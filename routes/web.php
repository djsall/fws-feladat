<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/logout', [
	LoginController::class,
	'logout'
]);

Route::middleware(['auth'])->group(function () {

	Route::get('/', function () {
		return redirect(route('projects.index'));
	})->name('index');

	Route::resource('projects', ProjectController::class, ['except' => ['destroy']]);

//delete
	Route::delete('/api/project/{projectId}/delete', [
		ProjectController::class,
		'destroy'
	])->name('projects.destroy');

	Route::resource('tickets', TicketController::class, ['except' => ['destroy']]);

	//delete
	Route::delete('/api/tickets/{ticket}/delete', [
		TicketController::class,
		'destroy'
	])->name('tickets.destroy');

	Route::resource('users', UserController::class, ['only' => ['index', 'store']]);
});
