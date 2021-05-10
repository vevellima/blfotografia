@extends('adminlte::page')

@section('title', 'Editar Nome dos Pacotes')

@section ('content_header')
    <h1>Editar Nome dos Pacotes</h1>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i>Ocorreu um erro:</h5>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="card">
        <div class="card-body">
            <form action="{{route('typepackages.update', ['typepackage' => $typepackage->id])}}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group col">
                    <label class="col-sm col-form-label">Editar Nome dos Pacotes</label>
                    <div class="col-sm">
                        <input type="text" name="name" value="{{$typepackage->name}}" class="form-control @error('name') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group col">
                    <label class="col-sm col-form-label">Nome do Pacote</label>
                    <div class="col-sm">
                        <textarea type="text" name="description" placeholder="{{$typepackage->description}}" class="form-control @error('description') is-invalid @enderror"></textarea>
                    </div>
                </div>
                <div class="form-group col">
                    <div class="col-sm">
                        <input type="submit" value="Salvar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
