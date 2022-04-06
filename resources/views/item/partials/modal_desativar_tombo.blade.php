
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
      function limparBusca(){
        $('#containerBuscaCampoValor select[name="campo[]"]').val("");
        $('#containerBuscaCampoValor input[name="valor[]"]').val("");
        $('select[name="status"]').val("");
        $('select[name="procedencia"]').val("");
        $('select[name="tipo_material"]').val("");
        $('select[name="tipo_aquisicao"]').val("");
        $('select[name="is_active"]').val("");
        $('input[name="data_sugestao_inicio"]').val("");
        $('input[name="data_sugestao_fim"]').val("");
        $('input[name="data_tombamento_inicio"]').val("");
        $('input[name="data_tombamento_fim"]').val("");
        $('input[name="data_processamento_inicio"]').val("");
        $('input[name="data_processamento_fim"]').val("");


        $('input[name="titulo"]').val("");
        $('input[name="autor"]').val("");
        $('input[name="tombo"]').val("");
        $('input[name="codigoimpressao"]').val("");
        $('input[name="observacao"]').val("");
        $('input[name="verba"]').val("");
        $('input[name="processo"]').val("");

        
        while($("#containerBuscaCampoValor .row").length > 1){
          $("#containerBuscaCampoValor .row").last().remove();
        }
        $("#btnRemove").addClass("d-none");
      }
      $(document).ready(function(){
      $("#btnAdd").click(function(){
        if( $("#containerBuscaCampoValor .row").last().find('input[name^="valor"').val().length == 0){
          alert('Por favor, preencha a última busca antes de adionar mais campos.');
        }else{
          var clone = $("#examploRowBuscaCampoValor .row").last().clone();
          $(clone).appendTo( "#containerBuscaCampoValor" );
          $("#btnRemove").removeClass("d-none");
        }
      });

      $("#btnRemove").click(function(){
        $("#containerBuscaCampoValor .row").last().remove();
        if( $("#containerBuscaCampoValor .row").length == 1){
          $("#btnRemove").addClass("d-none");
        }
      });

    });
  </script>
@stop