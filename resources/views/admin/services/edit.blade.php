@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>
        Editar Produto
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

    <form action="{{route('products.update', ['product' => $product->id])}}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Name</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control @error('name') is-invalid @enderror">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <input type="submit" value="Salvar" class="btn btn-success">
            </div>
        </div>
    </form>
</div>
@endsection
