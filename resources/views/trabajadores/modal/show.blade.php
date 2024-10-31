<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
    id="modal-show-{{ $rs->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información - Trabajador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Número de Identificación</label>
                        <input type="text" name="nrodoc" class="form-control"
                            placeholder="Número de Identificación" value="{{ $rs->nrodoc }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Trabajador</label>
                        <input type="text" name="entidad" class="form-control"
                            placeholder="Nombre de la Trabajador" value="{{ $rs->nombres .' '.$rs->apellidos }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control"
                            placeholder="Telefono de la Trabajador" value="{{ $rs->telefono }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Correo Electronico</label>
                        <input type="text" name="email" class="form-control"
                            placeholder="Correo Electronico" value="{{ $rs->email }}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>