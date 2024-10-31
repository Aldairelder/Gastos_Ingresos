<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-show-{{ $rs->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Información - Clase</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="clase" class="form-control" placeholder="Nombre de la Clase" value="{{ $rs->clase }}" readonly>
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Descripcion</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripcion de la Clase" value="{{ $rs->descripcion }}" readonly>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>