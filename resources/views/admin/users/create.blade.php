@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1>
        Cadastrar Novo Usuário
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

    <form action="{{route('users.store')}}" method="POST" class="form-horizontal">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-8">
                        <label class="col-sm col-form-label">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">Nasc.</label>
                        <input type="date" name="birthdate" value="{{old('birthdate')}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">CPF</label>
                        <input type="text" name="cpf" value="{{old('cpf')}}" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">RG</label>
                        <input type="text" name="rg" value="{{old('rg')}}" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">CNPJ</label>
                        <input type="text" name="cnpj" value="{{old('cnpj')}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">Telefone</label>
                        <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">E-mail</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">Site</label>
                        <input type="text" name="website" value="{{old('website')}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Logradouro (Rua/Av/Trav)</label>
                        <input type="text" name="address" value="{{old('address')}}" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Bairro</label>
                        <input type="text" name="neighborhood" value="{{old('neighborhood')}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">Cidade</label>
                        <input type="text" name="city" value="{{old('city')}}" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">Estado</label>
                        <input type="text" name="state" value="{{old('state')}}" class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label class="col-sm col-form-label">CEP</label>
                        <input type="text" name="zip_code" value="{{old('zip_code')}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Senha</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-sm col-form-label">Confirma Senha</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror">
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
