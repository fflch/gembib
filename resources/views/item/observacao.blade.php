<div class="form-group">
  <label for="observacao">Observações:</label>
  <textarea class="form-control" id="observacao" rows="3" name="observacao"> {{ $item->observacao ?? old('observacao') }} </textarea>
</div>