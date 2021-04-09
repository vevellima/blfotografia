@extends('adminlte::page')

@section('title', 'Agendar serviço')

@section('content_header')
    <h1>Agendar Serviço</h1>
@endsection

@section('js')
    <script type="text/javascript">
        function updateUser() {
            var select = document.getElementById('user');
            var option = select.options[select.selectedIndex];

            document.getElementById('user_id').value = option.value;
        }
        updateUser();

        function updatePackage() {
            var select = document.getElementById('package');
            var option = select.options[select.selectedIndex];

            document.getElementById('package_id').value = option.value;
        }
        updatePackage();

        function updatePayForm() {
            var select = document.getElementById('payform');
            var option = select.options[select.selectedIndex];

            document.getElementById('pay').value = option.value;
        }
        updatePayForm();
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
            <form action="{{route('services.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Cliente</label>
                            <select class="form-control ls-select" size="0" name="name" id="user" onChange="updateUser()">
                                <option value="0"></option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="user_id" id="user_id" value="" class="form-control @error ('user_id') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Pacote</label>
                            <select class="form-control ls-select" size="0" name="package" id="package" onChange="updatePackage()">
                                <option value="0"></option>
                                @foreach ($packages as $package)
                                    <option value="{{$package->id}}">{{$package->packagename->packagename}} - {{$package->product->product}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="package_id" id="package_id" value="" class="form-control @error ('package_id') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="local">Local</label>
                            <input type="text" name="local" id="local" value="{{old('local')}}" class="form-control @error ('name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="day">Data</label>
                            <input type="text" name="day" id="day" value="{{old('day')}}" class="form-control @error ('name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="hours">Hora</label>
                            <input type="text" name="hours" id="hours" value="{{old('hours')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="access_level">Forma de Pagamento</label>
                            <select class="form-control ls-select" size="0" id="payform" onChange="updatePayForm()">
                                <option value="0"></option>
                                <option value="1">1 vez</option>
                                <option value="2">2 vezes</option>
                                <option value="3">3 vezes</option>
                                <option value="4">4 vezes</option>
                                <option value="5">5 vezes</option>
                                <option value="6">6 vezes</option>
                            </select>
                            <input type="hidden" name="payform" id="pay" value="" class="form-control @error ('user_id') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="address">Logradouro (Rua, Estr., Av.)</label>
                            <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control @error ('address') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" value="{{old('neighborhood')}}" class="form-control @error ('neighborhood') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" name="city" id="city" value="{{old('city')}}" class="form-control @error ('city') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="state">UF</label>
                            <input type="text" name="state" id="state" value="{{old('state')}}" class="form-control @error ('state') is-invalid @enderror">
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
