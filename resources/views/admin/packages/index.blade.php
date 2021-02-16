@extends('adminlte::page')

@section('title', 'Pacotes')

@section('content_header')
    <h1>
        Cadastro de Pacotes
        <a href="{{route('packages.create')}}" class="btn btn-sm btn-success">Novo Pacote</a>
    </h1>

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pacote</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                    <th>Cadastrado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                <tr>
                    <td>{{$package->id}}</td>
                    <td>{{$package->packagename->name}}</td>
                    <td>{{$package->product->name}}</td>
                    <td>{{$package->price}},00</td>
                    <td>{{date('d/m/Y', strtotime($package->created_at))}}</td>
                    <td>
                        <a href="{{route('packages.edit', ['package'=>$package->id])}}" class="btn btn-sm btn-primary">Editar</a>
                        <form class="d-inline" method="POST" action="{{route('packages.destroy', ['package'=>$package->id])}}"  onsubmit="return confirm('Tem certeza que deseja excluir este Pacote?')">
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
{{$packages->links()}}
@endsection
