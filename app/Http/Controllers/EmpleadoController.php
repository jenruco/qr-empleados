<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EmpleadoController extends Controller
{
    /**
     * Listar empleados activos
     * 
     * @param $request {@link Request} - Parámetros de la solicitud (filtros, paginación, etc.)
     * @return {@link View} - Vista con la lista de empleados activos
     * 
     * @author Henry Pérez
     * @version 1.0
     * @since 05-02-2026
     * 
     */
    public function listaEmpleados(Request $request) {

        $empleados = Empleado::where('estado', 1)->get();
        return view('empleados.empleado', compact('empleados'));
    }

    /**
     * Guardar nuevo empleado
     * 
     * @param $request {@link Request} - Parámetros de la solicitud (filtros, paginación, etc.)
     * @return {@link View} - Vista con la lista de empleados activos
     * 
     * @author Henry Pérez
     * @version 1.0
     * @since 05-02-2026
     * 
     */
    public function guardar(Request $request) {
        try {

            $validated = $request->validate([
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'departamento' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
            ]);

            $empleado = new Empleado();
            $empleado->nombres = $validated['nombres'];
            $empleado->apellidos = $validated['apellidos'];
            $empleado->departamento = $validated['departamento'];
            $empleado->email = $validated['email'];
            $empleado->telefono = $validated['telefono'];
            $empleado->usr_creacion = 'admin'; //user en sesión

            $empleado->save();
            
            return redirect('/')->with('success', 'Empleado guardado exitosamente');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al guardar el empleado: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar (inactivar) empleado
     * 
     * @param $id {@link int} - ID del empleado a eliminar
     * @return {@link View} - Vista con la lista de empleados activos
     * 
     * @author Henry Pérez
     * @version 1.0
     * @since 05-02-2026
     * 
     */
    public function eliminar($id) {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->estado = 0;
            $empleado->usr_ult_mod = 'admin';
            $empleado->save();

            return redirect('/')->with('success', 'Empleado eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al eliminar el empleado: ' . $e->getMessage());
        }
    }

    /**
     * Generar código QR para empleados seleccionados
     * 
     * @param $request {@link Request} - Parámetros de la solicitud (filtros, paginación, etc.)
     * @return {@link json} - Información sobre el resultado de la generación del QR
     * 
     * @author Henry Pérez
     * @version 1.0
     * @since 05-02-2026
     * 
     */
    public function generarQR(Request $request) {
        try {
            
            $ids = $request->ids;

            foreach($ids as $id) {
                QrCode::format('svg')
                            ->size(300)
                            ->generate(
                                "EMP:$id",
                                public_path("/qrs/empleado_$id.svg")
                            );
            }

            return response()->json(['success' => true, 'message' => 'QR generado exitosamente ' . implode(', ', $ids)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al generar el QR: ' . $e->getMessage()]);
        }
    }
}
