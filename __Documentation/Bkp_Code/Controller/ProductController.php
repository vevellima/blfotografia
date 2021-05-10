<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    private $loggedUser;

    public function __construct() {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function list() {
        $array = ['error' => ''];

        $products = Product::all();
        $array['data'] = $products;    

        return $array;
    }

    public function add(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required'
        ]);

        if(!$validator->fails()) {
            $name = $request->input('name');
            $price = $request->input('price');

            $productExists = Product::where('name', $name)->count();
            
            if($productExists === 0){
                $newProduct = new Product();
                $newProduct->name = $name;
                $newProduct->price = $price;
                $newProduct->created_at = date('Y-m-d H:i:s');
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

    public function update(Request $request, $id) {
        $array = ['error' => ''];

        $product = Product::find($id);

        $rules = [
            'name' => 'min:2'
        ];

        $validator = Validator::make($request->All(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $name = $request->input('name');
        $price = $request->input('price');
        
        if($name) {
            $product->name = $name;
            $product->created_at = date('Y-m-d H:i:s');
        }
        if($price) {
            $product->price = $price;
            $product->created_at = date('Y-m-d H:i:s');
        }
        
        $product->save();       

        return $array;
    }

    public function one($id) {
        $array = ['error' => ''];

        $product = Product::find($id);

        if($product) {
            
            $array['data'] = $product;

        } else {
            $array['error'] = 'Produto não cadastrado!';
            return $array;
        }

        return $array;
    }   
}
