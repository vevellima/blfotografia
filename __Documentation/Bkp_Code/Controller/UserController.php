<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function read() {
        $array = ['error' => ''];

        $info = $this->loggedUser;
        $array['data'] = $info;    

        return $array;
    }

    public function list() {
        $array = ['error' => ''];

        $users = User::all();
        $array['data'] = $users;    

        return $array;
    }
    
    public function add(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$validator->fails()) {
            $name = $request->input('name');
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
            $email = $request->input('email');
            $website = $request->input('website');
            $password = $request->input('password');

            $emailExists = User::where('email', $email)->count();
            if($emailExists === 0){
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $newUser = new User();
                $newUser->name = $name;
                $newUser->access_level = 0;
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
                $newUser->email = $email;
                $newUser->website = $website;
                $newUser->password = $hash;
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

    public function update(Request $request, $id) {
        $array = ['error' => ''];

        $user = User::find($id);

        $rules = [
            'name' => 'min:2',
            'email' => 'email|unique:users',
            'password' => 'same:password_confirm',
            'password_confirm' => 'same:password'
        ];

        $validator = Validator::make($request->All(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $name = $request->input('name');
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
        $email = $request->input('email');
        $website = $request->input('website');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirm');

        if($name) {
            $user->name = $name;
        }
        if($cpf) {
            $user->cpf = $cpf;
        }
        if($cnpj) {
            $user->cnpj = $cnpj;
        }
        if($rg) {
            $user->rg = $rg;
        }
        if($birthdate) {
            $user->birthdate = $birthdate;
        }
        if($phone) {
            $user->phone = $name;
        }
        if($address) {
            $user->address = $address;
        }
        if($neighborhood) {
            $user->$neighborhood = $neighborhood;
        }
        if($city) {
            $user->city = $city;
        }
        if($state) {
            $user->$state = $state;
        }
        if($zip_code) {
            $user->zip_code = $zip_code;
        }
        if($email) {
            $user->email = $email;
        }
        if($website) {
            $user->website = $website;
        }
        if($password) {            
            $user->password = password_hash($password, PASSWORD_DEFAULT);
        }
        $user->save();       

        return $array;
    }
    
    public function one($id) {
        $array = ['error' => ''];

        $user = User::find($id);

        if($user) {
            
            $array['data'] = $user;

        } else {
            $array['error'] = 'Usuário não cadastrado!';
            return $array;
        }

        return $array;
    }   
}
