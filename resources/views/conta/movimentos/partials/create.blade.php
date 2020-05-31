
{{-- {{$errors}}
{{ $message ?? '' }} --}}
<div class="form-group">
    <label for="inputData">Data</label>
    <input type="date" class="form-control" name="data" id="inputData"  value="{{old('data', $movimento->data)}}">


    @error('data')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputValor">Valor do Movimento</label>
    <input type="number" step="0.01" class="form-control" name="valor" id="inputValor"  value="{{old('valor', $movimento->valor)}}">

    @error('valor')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


<div class="item-form">
                <label for="idCategoria">Categoria pretendida: </label>
                <select name="categoria" id="idCcategoria">
                    @foreach($categorias as $categoria)

                        <option value={{$categoria->id}} {{old('categoria')==$categoria->id?'selected':''}}>{{$categoria->nome}} tipo: {{$categoria->tipo}}</option>

                    @endforeach
                </select>

                @error('categoria')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror

</div>

<div class="form-right-area">
            <div id="origem-area">
                <div class="title-items">Tipo de Movimento:</div>
                <div class="item-form">
                    <input type="radio" name="tipo" id="idTipoR" value="R" {{old('tipo',$movimento->tipo)=='R'?'checked':''}}>
                    <label for="idTipoR">Receita</label>
                </div>
                <div class="item-form">
                    <input type="radio" name="tipo" id="idTipoD" value="D" {{old('tipo',$movimento->tipo)=='D'?'checked':''}}>
                    <label for="idTipoD">Despesa</label>
                </div>
            </div>
            @error('tipo')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
</div>


<div class="form-group">
    <label for="inputDescricao">Descrição do Movimento</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao"  value="{{old('descricao', $movimento->descricao)}}">


    @error('descricao')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<input type="file" name="fileToUpload" id="fileToUpload" accept="image/x-png,image/gif,image/jpeg"/>
