@extends('adminlte::page')

@section('title', 'Serviços')

@section('content_header')
    <h1>
        Serviços de Fotografia - Contratos
        <a href="{{route('services.create')}}" class="btn btn-sm btn-success">Novo Contrato</a>
    </h1>

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Pacote</th>
                    <th>Data da Contratação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->servuser->first('name')}}</td>
                    <td>{{$service->package->packagename->name}}</td>
                    <td>{{date('d/m/Y', strtotime($service->created_at))}}</td>
                    <td>
                        <a href="{{route('services.edit', ['service'=>$service->id])}}" class="btn btn-sm btn-primary">Editar</a>
                        <form class="d-inline" method="POST" action="{{route('services.destroy', ['service'=>$service->id])}}"  onsubmit="return confirm('Tem certeza que deseja excluir este Serviço?')">
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
{{$services->links()}}
@endsection
