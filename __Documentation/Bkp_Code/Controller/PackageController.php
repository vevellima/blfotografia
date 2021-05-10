<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Package;

class PackageController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function list() {
        $array = ['error' => ''];

        $packages = Package::all();
        $array['data'] = $packages;    

        return $array;
    }

    public function add(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if(!$validator->fails()) {
            $name = $request->input('name');

            $packageExists = Package::where('name', $name)->count();
            
            if($packageExists === 0){
                $newPackage = new Package();
                $newPackage->name = $name;
                $newPackage->created_at = date('Y-m-d H:i:s');
                $newPackage->save();

            } else {
                $array['error'] = 'Produto já cadastrado!';
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

        $package = Package::find($id);

        $rules = [
            'name' => 'min:2'
        ];

        $validator = Validator::make($request->All(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $name = $request->input('name');
        
        if($name) {
            $package->name = $name;
            $package->created_at = date('Y-m-d H:i:s');
        }

        $package->save();       

        return $array;
    }

    public function one($id) {
        $array = ['error' => ''];

        $package = Package::find($id);

        if($package) {
            
            $array['data'] = $package;

        } else {
            $array['error'] = 'Produto não cadastrado!';
            return $array;
        }

        return $array;
    }   
}
