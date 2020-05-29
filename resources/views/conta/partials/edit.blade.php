<div class="form-group">
    <label for="inputNome">Saldo Atual</label>
    <input type="number" class="form-control" name="saldo_atual" id="inputSaldoAtual"  value="{{old('saldo_atual', $conta->saldo_atual)}}">


    @error('saldo_atual')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
