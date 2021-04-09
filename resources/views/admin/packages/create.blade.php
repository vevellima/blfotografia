@extends('adminlte::page')

@section('title', 'Novo Pacote')

@section('content_header')
    <h1>Novo Pacote</h1>
@endsection

@section('js')
    <script type="text/javascript">
        function updateNamePackage() {
            var select = document.getElementById('packagename');
            var option = select.options[select.selectedIndex];

            document.getElementById('packagename_id').value = option.value;
        }
        updateNamePackage();

        function updateProduct() {
            var select = document.getElementById('product');
            var option = select.options[select.selectedIndex];

            document.getElementById('product_id').value = option.value;
        }
        updateProduct();
    </script>
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
            <form action="{{route('packages.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Nome do Pacote</label>
                            <select class="form-control ls-select" size="0" name="packagename" id="packagename" onChange="updateNamePackage()">
                                <option value="0"></option>
                                @foreach ($packagenames as $packagename)
                                    <option value="{{$packagename->id}}">{{$packagename->packagename}} - {{$packagename->description}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="packagename_id" id="packagename_id" value="" class="form-control @error ('packagename_id') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Produto</label>
                            <select class="form-control ls-select" size="0" name="product" id="product" onChange="updateProduct()">
                                <option value="0"></option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->product}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="product_id" id="product_id" value="" class="form-control @error ('product_id') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Preço (sem casas decimais)</label>
                            <input type="text" name="price" id="price" value="" class="form-control @error ('price') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label></label>
                            <input type="submit" value="Cadastrar" class="btn btn-success"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
