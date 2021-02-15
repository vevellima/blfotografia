@extends('adminlte::page')

@section('title', 'Cadastrar - Nome de Pacote')

@section('content_header')
    <h1>
        Cadastrar Novo Nome de Pacote
    </h1>

@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i>
                Ocorreu um erro:
            </h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('packagenames.store')}}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Descrição</label>
                        <input type="text" name="description" value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <input type="submit" value="Cadastrar" class="btn btn-success">
            </div>
        </div>
    </form>
</div>
@endsection
