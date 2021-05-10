@extends('adminlte::page')

@section('title', 'Novo Nome do Pacote')

@section ('content_header')
    <h1>Novo Nome de Pacote</h1>
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
            <form action="{{route('typepackages.store')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group col">
                    <label class="col-sm col-form-label">Nome do Pacote</label>
                    <div class="col-sm>">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group col">
                    <label class="col-sm col-form-label">Nome do Pacote</label>
                    <div class="col-sm">
                        <textarea type="text" name="description" value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror"></textarea>
                    </div>
                </div>
                <div class="form-group col">
                    <div class="col-sm">
                        <input type="submit" value="Cadastrar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
