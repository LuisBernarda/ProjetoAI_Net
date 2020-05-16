<div class="form-group">
    <label for="inputNome">Nome da Conta</label>
    <input type="text" class="form-control" name="name" id="inputNome" >


    @error('name')
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
    <input type="text" class="form-control" name="saldo_inicial" id="inputSaldoInicial" >


    @error('saldo_inicial')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
