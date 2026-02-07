<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Empleados</title>
    <link rel="icon" type="image/png" href="{{ asset('codigo-qr.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        window.flashMessages = {
            success: @json(session('success')),
            error: @json(session('error'))
        };
    </script>

    @Vite(['resources/js/app.js']) <!-- agrega para acceder a empleados.js -->

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0">
                <i class="bi bi-people-fill me-2"></i>Empleados
            </h3>
            <div class="d-flex flex-wrap mt-5">
                <form action="{{ route('empleado.lista') }}"
                                    method="GET">
                    <div class="col-md-12 mb-3">
                        <label for="nombresFiltro" class="form-label">Nombres</span></label>
                        <input type="text" class="form-control" 
                            id="nombresFiltro" name="nombresFiltro">
                    </div>

                    <button class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Buscar
                    </button>
                    <a href="{{ route('empleado.lista') }}" class="btn btn-primary">
                        <i class="bi bi-x-circle"></i> Limpiar
                    </a>
                </form>
                
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                <div class="d-flex gap-2 ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoEmpleado">
                        <i class="bi bi-plus-circle"></i> Nuevo Empleado
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-generar-qr">
                        <i class="bi bi-plus-circle"></i> Generar QR
                    </button>
                </div>

                <table class="table table-striped table-hover" style="table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado['id'] }}</td>
                            <td>{{ $empleado->nombres }} {{ $empleado['apellidos'] }}</td>
                            <td>{{ $empleado['departamento'] }}</td>
                            <td>{{ $empleado['email'] }}</td>
                            <td>{{ $empleado['telefono'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-editar-empleado" data-id="{{ $empleado->id }}">Editar</button>

                                <form action="{{ route('empleado.eliminar', $empleado->id) }}"
                                        method="POST"
                                        class="form-eliminar d-inline">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>

                                <button class="btn btn-sm btn-warning btn-ver-qr" data-id="{{ $empleado->id }}">Ver QR</button>

                                <div class="form-check">
                                    <input class="form-check-input checkbox-empleado" 
                                        type="checkbox"
                                        name="empleados_seleccionados[]" 
                                        value="{{ $empleado->id }}" 
                                        id="empleado-{{ $empleado->id }}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('empleados.modal.modal-crea-empleado', ['titulo' => 'Crear Empleado'])
    @include('empleados.modal.modal-qr-empleado', ['titulo' => 'QR Empleado'])
</body>

</html>