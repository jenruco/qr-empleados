<div class="modal fade" id="modalQrEmpleado" tabindex="-1" aria-labelledby="modalQrEmpleadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/guardar" method="POST">
                @csrf
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalQrEmpleadoLabel">{{$titulo ?? 'QR Empleado'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="qrCodeContainer"></div>
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