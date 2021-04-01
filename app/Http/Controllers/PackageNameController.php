<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PackageName;

class PackageNameController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = Auth::user();
    }

    public function create(Request $request)
    {
        $array = ['error' => ''];
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if (!$validator->fails()) {
            $name = $request->input('name');
            $description = $request->input('description');
            $nameExists = PackageName::where('name', $name)->count();
            if ($nameExists === 0) {
                $newPackageName = new PackageName();
                $newPackageName->name = $name;
                $newPackageName->description = $description;
                $newPackageName->created_at = date('Y-m-d H:i:s', strtotime(now()));
                $newPackageName->save();
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

    public function read(Request $request)
    {
        $array = ['error' => ''];

        $id = $request->input('id');

        $info = PackageName::find($id);
        $array['data'] = $info;

        return $array;
    }

    public function list()
    {
        $array = ['error' => ''];

        $listPackageNames = PackageName::all();
        $array['PackageNames'] = $listPackageNames;

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'name' => 'unique:packagenames',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');

        $packageName = PackageName::find($id);

        if ($name) {
            $packageName->name = $name;
        }
        if ($description) {
            $packageName->description = $description;
        }

        $packageName->save();

        return $array;
    }
}
