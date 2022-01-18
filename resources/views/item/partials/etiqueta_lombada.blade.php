<form method="POST" action="/item/etiqueta_update/{{$item->id}}">
    @csrf
<div class="row">
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="no_classificacao" value="{{ $item->no_classificacao }}" placeholder="No. Classificação">
        </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="no_cutter" value="{{ $item->no_cutter }}" placeholder="No. Cutter">
        </div>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-2">
            <input type="text" name="exemplar" value="{{ $item->exemplar  }}" placeholder="Exemplar"> 
        </div>
    </div>
</div>
