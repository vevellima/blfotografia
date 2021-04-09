@extends('adminlte::page')

@section('title', 'Editar Pacote')

@section('content_header')
    <h1>Editar Pacote</h1>
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
            <form action="{{route('packages.update', ['package' => $package->id])}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Pacote</label>
                            <input type="text" name="packagename" id="packagename" value="{{$package->packagename->packagename}} - {{$package->packagename->description}}" class="form-control @error ('name') is-invalid @enderror" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Produto</label>
                            <input type="text" name="description" id="description" value="{{$package->product->product}}" class="form-control @error ('description') is-invalid @enderror" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Preço</label>
                            <input type="text" name="price" id="price" value="{{$package->price}}" class="form-control @error ('description') is-invalid @enderror">
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
