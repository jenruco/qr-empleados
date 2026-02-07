<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [EmpleadoController::class, 'listaEmpleados']);

Route::post('/guardar', [EmpleadoController::class, 'guardar']);

Route::delete('/eliminar/{id}', [EmpleadoController::class, 'eliminar'])->name('empleado.eliminar');

Route::post('/generar-qr', [EmpleadoController::class, 'generarQR'])->name('empleado.generarQR');
