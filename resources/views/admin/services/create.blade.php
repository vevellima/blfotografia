@extends('adminlte::page')

@section('title', 'Serviço Fotográfico')

@section('js')
    <script type="text/javascript">
        $("#user").on('click', function(){
            var select = document.getElementById('user');
            var option = select.options[select.selectedIndex];

            document.getElementById('valueNameUser').value = option.value;
        });
        $("#package").on('click', function(){
            var select = document.getElementById('package');
            var option = select.options[select.selectedIndex];

            document.getElementById('valueNamePackage').value = option.value;
        });
    </script>
@endsection

@section('content_header')
    <h1>
        Contratação de Serviço Fotográfico
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

    <form action="{{route('services.store')}}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Selecione o nome do cliente</label>
                        <select class="col-sm form-control" id="user" size="-1" onChange="updateNameUser()">
                            <option value="-1">Selecione uma opção...</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="user_id" id="valueNameUser">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Selecione o nome do pacote</label>
                        <select class="col-sm form-control" id="package" size="-1" onChange="updatePackageName()">
                            <option value="-1">Selecione uma opção...</option>
                            @foreach ($packages as $package)
                                <option value="{{$package->id}}">{{$package->packagename->name}} - {{$package->product->name}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="package_id" id="valueNamePackage">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-2">
                        <label class="col-sm col-form-label">Quant. de Parcelas</label>
                        <input type="text" name="payform" class="form-control @error('payform') is-invalid @enderror">
                    </div>
                    <div class="form-group col-2">
                        <label class="col-sm col-form-label">Dia do Evento</label>
                        <input type="text" name="day" class="form-control @error('day') is-invalid @enderror">
                    </div>
                    <div class="form-group col-2">
                        <label class="col-sm col-form-label">Horário do Evento</label>
                        <input type="text" name="hours" class="form-control @error('hours') is-invalid @enderror">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Local do Evento</label>
                        <input type="text" name="local" class="form-control @error('local') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Endereço</label>
                        <input type="text" name="address" class="form-control @error('payform') is-invalid @enderror">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Bairro</label>
                        <input type="text" name="neighborhood" class="form-control @error('day') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Cidade</label>
                        <input type="text" name="city" class="form-control @error('hours') is-invalid @enderror">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Estado</label>
                        <input type="text" name="state" class="form-control @error('local') is-invalid @enderror">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <input type="submit" value="Contratar" class="btn btn-success">
            </div>
        </div>
    </form>
</div>
@endsection
