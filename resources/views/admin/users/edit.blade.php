@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
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
            <form action="{{route('users.update', ['user' => $user->id])}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error ('name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="birthdate">Data Nasc.</label>
                            <input type="text" name="birthdate" id="birthdate" value="{{$user->birthdate}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="access_level">Nível Acesso</label>
                            <input type="text" name="access_level" id="access_level" value="{{$user->access_level}}" class="form-control @error ('access_level') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" value="{{$user->cpf}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" id="rg" value="{{$user->rg}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" value="{{$user->cnpj}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address">Logradouro (Rua, Trav., Av.)</label>
                            <input type="text" name="address" id="address" value="{{$user->address}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" value="{{$user->neighborhood}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" name="city" id="city" value="{{$user->city}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="zip_code">CEP</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{$user->zip_code}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="state">UF</label>
                            <input type="text" name="state" id="state" value="{{$user->state}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control @error ('email') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" value="{{$user->website}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="password">Nova Senha</label>
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
                            <input type="submit" value="Salvar" class="btn btn-success"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
