@extends('adminlte::page')

@section('title', 'Editar Nome do Pacote')

@section('content_header')
    <h1>Editar Nome do Pacote</h1>
@endsection

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Listagem de Erro(s):
                </h5>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('packagenames.update', ['packagename' => $packagename->id])}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="packagename">Nome do Pacote</label>
                            <input type="text" name="name" id="packagename" value="{{$packagename->packagename}}" class="form-control @error ('packagename') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Descrição</label>
                            <input type="text" name="description" id="description" value="{{$packagename->description}}" class="form-control @error ('description') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label></label>
                            <input type="submit" value="Salvar" class="btn btn-success"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
