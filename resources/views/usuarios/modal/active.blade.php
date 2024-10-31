<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-active-{{ $rs->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('usuarios.active', $rs->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h4 class="modal-title">Activar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Confirme si desea Activar el Usuario : <strong>{{ $rs->usuario }}</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>