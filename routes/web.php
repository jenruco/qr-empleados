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

Route::get('/', function () {
    return redirect()->route('empleado.lista');
});

Route::prefix('empleados')->group(function() {
    Route::get('/', [EmpleadoController::class, 'listaEmpleados'])->name('empleado.lista');
    
    Route::post('/guardar', [EmpleadoController::class, 'guardar'])->name('empleado.guardar');
    
    Route::get('/{id}', [EmpleadoController::class, 'obtenerEmpleado'])->name('empleado.obtener');
    
    Route::delete('/eliminar/{id}', [EmpleadoController::class, 'eliminar'])->name('empleado.eliminar');
    
    Route::post('/generar-qr', [EmpleadoController::class, 'generarQR'])->name('empleado.generarQR');
    
    Route::get('/obtener-qr/{id}', [EmpleadoController::class, 'obtenerQR'])->name('empleado.obtenerQR');
});
