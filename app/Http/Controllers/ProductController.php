<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
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
            $nameExists = Product::where('name', $name)->count();
            if ($nameExists === 0) {
                $newProduct = new Product();
                $newProduct->name = $name;
                $newProduct->created_at = date('Y-m-d H:i:s', strtotime(now()));
                $newProduct->save();
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

        $info = Product::find($id);
        $array['data'] = $info;

        return $array;
    }

    public function list()
    {
        $array = ['error' => ''];

        $listProducts = Product::all();
        $array['Products'] = $listProducts;

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'name' => 'unique:products',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $name = $request->input('name');

        $product = Product::find($id);

        if ($name) {
            $product->name = $name;
        }

        $product->save();

        return $array;
    }
}
