@extends('adminlte::page')

@section('title', 'Editar - Pacote')

@section('js')
    <script type="text/javascript">
        $("#package").on('click', function(){
            var select = document.getElementById('package');
            var option = select.options[select.selectedIndex];

            document.getElementById('valueNamePackage').value = option.value;
        });
        $("#product").on('click', function(){
            var select = document.getElementById('product');
            var option = select.options[select.selectedIndex];

            document.getElementById('valueProduct').value = option.value;
        });
    </script>
@endsection

@section('content_header')
    <h1>
        Editar Pacote
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

    <form action="{{route('packages.update', ['package' => $package->id])}}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Selecione o Novo Nome de Pacote</label>
                        <select class="col-sm form-control" id="package" size="-1" onChange="updateNamePackage()">
                            <option value="-1">{{$package->packagename->name}}</option>
                            @foreach ($packagenames as $packagename)
                                <option value="{{$packagename->id}}">{{$packagename->name}} - {{$packagename->description}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="packagename_id" value="{{$package->packagename_id}}" id="valueNamePackage">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Selecione o Novo Produto</label>
                        <select class="col-sm form-control" id="product" size="-1" onChange="updateProduct()">
                            <option value="-1">{{$package->product->name}}</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="product_id" value="{{$package->product_id}}" id="valueProduct">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label class="col-sm col-form-label">Preço</label>
                        <input type="text" name="price" class="form-control" value="{{$package->price}},00" @error('price') is-invalid @enderror">
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
