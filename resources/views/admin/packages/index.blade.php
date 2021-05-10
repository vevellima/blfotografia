@extends('adminlte::page')

@section('title', 'Pacotes')

@section('content_header')
    <h1>
        Cadastro de Pacotes
        <a href="{{route('packages.create')}}" class="btn btn-sm btn-success">Adicionar</a>
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
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td>{{$package->id}}</td>
                            <td>{{$package->product->product}}</td>
                            <td>{{$package->packagename->packagename}} - {{$package->packagename->description}}</td>
                            <td>{{$package->price}},00</td>
                            <td>
                                <a href="{{route('packages.edit', ['package' => $package->id])}}" class="btn btn-sm btn-info">Editar</a>
                                <form class="d-inline" action="{{route('packages.destroy', ['package' => $package->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
    {{$packages->links()}}
@endsection
