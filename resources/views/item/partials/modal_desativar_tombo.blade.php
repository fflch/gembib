
<!-- Modal -->
<div class="modal fade" id="desativarTomboModal" tabindex="-1" role="dialog" aria-labelledby="desativarTomboModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarTomboModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="/item/is_active"> 
            @csrf
            <input type="hidden" id="desativarTomboId" name="tombo">
            <input type="hidden" name="is_active" value="0">
            <div class="form-group">
              <label>Por favor, preencha o motivo da ocorrência <span class="text-danger">*</span>:</label>
              <textarea class="form-control" name="motivo_desativamento" rows="3" max-legth="500" require></textarea>
            </div>
          <button type="submit" class="btn btn-danger w-100"> Desativar </button>  
        </form>
      </div>
    </div>
  </div>
</div>



@section('javascripts_bottom')
<script>
   function desativarTombo(tombo){
        $('#desativarTomboModal').modal('show');
        $("#desativarTomboModalTitle").text('Desativar Tombo N°'+tombo);
        $("#desativarTomboId").val(tombo);
      }
  </script>
@stop