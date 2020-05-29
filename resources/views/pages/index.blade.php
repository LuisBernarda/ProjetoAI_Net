@extends('layout')
@section('content')
<h2>Apresentação</h2>
<p>
    A aplicação "Finanças Pessoais" atribui aos seus utilizadores os seguintes estatutos:
</p>
<ul>
    <li>Administrador;</li>
    <li>Utilizador Normal;</li>
    <li>Utilizador Anónimo.</li>
</ul>
<h3>Funcionalidades</h3>
<p>
    Criação de contas, tendo os utilizadores da aplicação têm um perfil publico, com o nome,
    email e foto (a foto é opcional) e uma área privada, onde poderão registar todos os seus
    movimentos financeiros (receitas e despesas) organizados por contas, ver um sumário do
    estado das suas finanças e aceder a informação estatística sobre as suas receitas e despesas.
</p>
<p>
    Organização de movimentos por contas que podem representar contas no banco ou qualquer outra
    forma de organização a definir pelo utilizador. Por exemplo, um utilizador pode ter as contas:
    "conta à ordem do banco X", "conta poupança do banco Y", "dinheiro em caixa", "dinheiro para
    urgências", "poupança para férias", "educação", "carro", "viagens", etc. 
</p>
@endsection
