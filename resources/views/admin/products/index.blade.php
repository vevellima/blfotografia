@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>
        Cadastro de Produtos
        <a href="{{route('products.create')}}" class="btn btn-sm btn-success">Novo Produto</a>
    </h1>

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Cadastrado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{date('d/m/Y', strtotime($product->created_at))}}</td>
                    <td>
                        <a href="{{route('products.edit', ['product'=>$product->id])}}" class="btn btn-sm btn-primary">Editar</a>
                        <form class="d-inline" method="POST" action="{{route('products.destroy', ['product'=>$product->id])}}"  onsubmit="return confirm('Tem certeza que deseja excluir este Produto?')">
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
{{$products->links()}}
@endsection
