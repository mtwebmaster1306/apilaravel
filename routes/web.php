<?php

use App\Http\Controllers\AdminOrdenController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DominioAdminController;
use App\Http\Controllers\DominioController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TodosController;
use JeroenNoten\LaravelAdminLte\AdminLte;

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/admin/ordenes', [AdminOrdenController::class, 'index'])->name('admin.ordenes.index');
Route::get('/admin/ordenes/create', [AdminOrdenController::class, 'create'])->name('admin.ordenes.create');
Route::post('/admin/ordenes/store', [AdminOrdenController::class, 'store'])->name('admin.ordenes.store');
    Route::post('/admin/dominios', [DominioAdminController::class, 'store'])->name('admin.dominios.store');
    Route::get('/admin/dominios/{id}/edit', [DominioAdminController::class, 'edit']);
    Route::put('/admin/dominios/{id}', [DominioAdminController::class, 'update']);
    Route::get('/todos', [TodosController::class, 'index'])->name('todos.index');
    Route::resource('clientes', ClienteController::class); // Define todas las rutas de recursos para ClienteController
    Route::post('/admin/register', [AdminUserController::class, 'register'])->name('admin.register');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dominio', DominioController::class)->names('dominios');
    Route::resource('/ordenes', OrdenController::class);
    Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
    });
});