<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{old('name', $user->name)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail" value="{{old('email', $user->email)}}" >
    @error('email')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="text" class="form-control" name="password" id="inputPassword" value="{{old('password', $user->password)}}" >
    @error('password')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputPassword">NIF</label>
    <input type="text" class="form-control" name="NIF" id="inputNIF" value="{{old('NIF', $user->NIF)}}" >
    @error('NIF')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputPassword">telefone</label>
    <input type="text" class="form-control" name="telefone" id="inputTelefone" value="{{old('telefone', $user->telefone)}}" >
    @error('telefone')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="foto" id="inputFoto">
    @error('foto')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

