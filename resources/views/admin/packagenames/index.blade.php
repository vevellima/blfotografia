@extends('adminlte::page')

@section('title', 'Nome de Pacotes')

@section('content_header')
    <h1>
        Cadastro de Nome de Pacotes
        <a href="{{route('packagenames.create')}}" class="btn btn-sm btn-success">Adicionar</a>
    </h1>

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pacote</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packagenames as $packagename)
                        <tr>
                            <td>{{$packagename->id}}</td>
                            <td>{{$packagename->name}}</td>
                            <td>{{$packagename->description}}</td>
                            <td>{{date('d/m/Y', strtotime(date($packagename->created_at)))}}</td>
                            <td>
                                <a href="{{route('packagenames.edit', ['packagename' => $packagename->id])}}" class="btn btn-sm btn-info">Editar</a>
                                <form class="d-inline" action="{{route('packagenames.destroy', ['packagename' => $packagename->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{$packagenames->links()}}
@endsection
