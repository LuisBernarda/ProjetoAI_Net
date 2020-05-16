<div class="form-group">
    <label for="inputNome">Nome da Conta</label>
    <input type="text" class="form-control" name="nome" id="inputNome" >


    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" >


    @error('descricao')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputSaldoInicial">Saldo Inicial</label>
    <input type="text" class="form-control" name="saldo_abertura" id="inputSaldoInicial" >


    @error('saldo_abertura')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
