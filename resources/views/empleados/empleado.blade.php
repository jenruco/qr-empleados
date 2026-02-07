<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
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

    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Empleados</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoEmpleado">
                <i class="bi bi-plus-circle"></i> Nuevo Empleado
            </button>
            <button type="button" class="btn btn-primary" id="btn-generar-qr">
                <i class="bi bi-plus-circle"></i> Generar QR
            </button>
        </div>

        <table class="table table-striped table-hover">
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
                        <button class="btn btn-sm btn-warning">Editar</button>

                        <form action="{{ route('empleado.eliminar', $empleado->id) }}"
                                method="POST"
                                class="form-eliminar d-inline">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>

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

        <div class="modal fade" id="modalNuevoEmpleado" tabindex="-1" aria-labelledby="modalNuevoEmpleadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="/guardar" method="POST">
                        @csrf
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoEmpleadoLabel">Nuevo Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="row">
                                <!-- Nombres -->
                                <div class="col-md-6 mb-3">
                                    <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                        id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Apellidos -->
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                        id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                                    @error('apellidos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Departamento -->
                                <div class="col-md-6 mb-3">
                                    <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                                    <select class="form-select @error('departamento') is-invalid @enderror" 
                                            id="departamento" name="departamento" required>
                                        <option value="">Seleccione un departamento</option>
                                        <option value="Recursos Humanos" {{ old('departamento') == 'Recursos Humanos' ? 'selected' : '' }}>Recursos Humanos</option>
                                        <option value="Sistemas" {{ old('departamento') == 'Sistemas' ? 'selected' : '' }}>Sistemas</option>
                                        <option value="Contabilidad" {{ old('departamento') == 'Contabilidad' ? 'selected' : '' }}>Contabilidad</option>
                                        <option value="Ventas" {{ old('departamento') == 'Ventas' ? 'selected' : '' }}>Ventas</option>
                                        <option value="Operaciones" {{ old('departamento') == 'Operaciones' ? 'selected' : '' }}>Operaciones</option>
                                    </select>
                                    @error('departamento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                        id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                        placeholder="0999999999">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>