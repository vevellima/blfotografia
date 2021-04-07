@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
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
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error ('name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="birthdate">Data Nasc.</label>
                            <input type="text" name="birthdate" id="birthdate" value="{{old('birthdate')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="access_level">Nível Acesso</label>
                            <input type="text" name="access_level" id="access_level" value="{{old('access_level')}}" class="form-control @error ('access_level') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" value="{{old('cpf')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value="{{old('rg')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" value="{{old('cnpj')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address">Logradouro (Rua, Trav., Av.)</label>
                            <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" value="{{old('neighborhood')}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" name="city" id="city" value="{{old('city')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="zip_code">CEP</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{old('zip_code')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state">UF</label>
                            <input type="text" name="state" id="state" value="{{old('state')}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control @error ('email') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" value="{{old('website')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="password_confirmation">Confirma senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error ('password') is-invalid @enderror">
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
