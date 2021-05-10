@extends('adminlte::page')

@section('title', 'Nome dos Pacotes')

@section ('content_header')
    <h1>
        Cadastro de Nomes de Pacotes
        <a href="{{route('typepackages.create')}}" class="btn btn-sm btn-success">Novo</a>
    </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Description</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($typepackages as $typepackage)
                    <tr>
                        <td>{{$typepackage->id}}</td>
                        <td>{{$typepackage->name}}</td>
                        <td>{{$typepackage->description}}</td>
                        <td>
                            <a href="{{route('typepackages.edit', ['typepackage' => $typepackage->id])}}" class="btn btn-sm btn-info">Editar</a>
                            <form class="d-inline" action="{{route('typepackages.destroy', ['typepackage' => $typepackage->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{$typepackages->links()}}
@endsection
