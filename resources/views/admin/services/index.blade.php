@extends('adminlte::page')

@section('title', 'Serviços')

@section('content_header')
    <h1>
        Serviços de Fotografia Agendados
        <a href="{{route('services.create')}}" class="btn btn-sm btn-success">Agendar</a>
    </h1>

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Evento</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->user->name}}</td>
                            <td>{{$service->package->product->product}}</td>
                            <td>{{$service->local}}</td>
                            <td>{{$service->day}}</td>
                            <td>{{$service->hours}}</td>
                            <td>
                                <a href="{{route('services.edit', ['service' => $service->id])}}" class="btn btn-sm btn-info">Editar</a>
                                <form class="d-inline" action="{{route('services.destroy', ['service' => $service->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
    {{$services->links()}}
@endsection
