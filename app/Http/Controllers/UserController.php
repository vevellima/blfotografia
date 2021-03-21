<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function create(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$validator->fails()) {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $access_level = $request->input('access_level');
            $cpf = $request->input('cpf');
            $cnpj = $request->input('cnpj');
            $rg = $request->input('rg');
            $birthdate = $request->input('birthdate');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $neighborhood = $request->input('neighborhood');
            $city = $request->input('city');
            $state = $request->input('state');
            $zip_code = $request->input('zip_code');
            $website = $request->input('website');

            $emailExists = User::where('email', $email)->count();

            if ($emailExists === 0) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->password = $hash;
                $newUser->access_level = $access_level;
                $newUser->cpf = $cpf;
                $newUser->cnpj = $cnpj;
                $newUser->rg = $rg;
                $newUser->birthdate = $birthdate;
                $newUser->phone = $phone;
                $newUser->address = $address;
                $newUser->neighborhood = $neighborhood;
                $newUser->city = $city;
                $newUser->state = $state;
                $newUser->zip_code = $zip_code;
                $newUser->website = $website;
                $newUser->save();
            } else {
                $array['error'] = 'E-mail já cadastrado!';
                return $array;
            }
        } else {
            $array['error'] = 'Dados incorretos!';
            return $array;
        }

        return $array;
    }

    public function read(Request $request)
    {
        $array = ['error' => ''];

        $id = $request->input('id');

        $info = User::find($id);
        $array['data'] = $info;

        return $array;
    }

    public function list()
    {
        $array = ['error' => ''];

        $listUsers = User::all();
        $array['users'] = $listUsers;

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'name' => 'min:2',
            'email' => 'email|unique:users',
            'password' => 'min:4|same:password_confirm',
            'password_confirm' => 'min:4|same:password'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $access_level = $request->input('access_level');
        $cpf = $request->input('cpf');
        $cnpj = $request->input('cnpj');
        $rg = $request->input('rg');
        $birthdate = $request->input('birthdate');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $neighborhood = $request->input('neighborhood');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip_code = $request->input('zip_code');
        $website = $request->input('website');

        $user = User::find($id);

        if ($name) {
            $user->name = $name;
        }
        if ($email) {
            $user->email = $email;
        }
        if ($password) {
            $user->password = password_hash($password, PASSWORD_DEFAULT);
        }
        if ($access_level) {
            $user->access_level = $access_level;
        }
        if ($cpf) {
            $user->cpf = $cpf;
        }
        if ($cnpj) {
            $user->cnpj = $cnpj;
        }
        if ($rg) {
            $user->rg = $rg;
        }
        if ($birthdate) {
            $user->birthdate = $birthdate;
        }
        if ($phone) {
            $user->phone = $phone;
        }
        if ($address) {
            $user->address = $address;
        }
        if ($neighborhood) {
            $user->neighborhood = $neighborhood;
        }
        if ($city) {
            $user->city = $city;
        }
        if ($state) {
            $user->state = $state;
        }
        if ($zip_code) {
            $user->zip_code = $zip_code;
        }
        if ($website) {
            $user->website = $website;
        }
        $user->save();

        return $array;
    }
}
