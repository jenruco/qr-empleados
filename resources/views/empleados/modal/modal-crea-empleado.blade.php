<div class="modal fade" id="modalNuevoEmpleado" tabindex="-1" aria-labelledby="modalNuevoEmpleadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('empleado.guardar') }}" method="POST">
                        @csrf
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoEmpleadoLabel">{{$titulo ?? 'Nuevo Empleado'}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="row">

                                <!-- IdEmpleado -->
                                <input type="number" class="form-control" 
                                            id="idEmpleado" name="idEmpleado" value="" hidden>
                                            
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