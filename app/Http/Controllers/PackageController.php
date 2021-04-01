<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Package;
use App\Models\Product;
use App\Models\PackageName;

class PackageController extends Controller
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

        $packagename_id = $request->input('packagename_id');
        $product_id = $request->input('product_id');
        $price = $request->input('price');

        $newPackage = new Package();
        $newPackage->packagename_id = $packagename_id;
        $newPackage->product_id = $product_id;
        $newPackage->price = $price;
        $newPackage->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $newPackage->save();

        return $array;
    }

    public function read(Request $request)
    {
        $array = ['error' => ''];

        $id = $request->input('id');
        $package = Package::find($id);
        $info = [];

        $info[] = $package;
        $info[] = Packagename::find($package->packagename_id);
        $info[] = Product::find($package->product_id);

        $array['data'] = $info;

        return $array;
    }

    public function list()
    {
        $array = ['error' => ''];

        $packages = Package::all();
        $info = [];

        foreach ($packages as $package) {
            $info[] = $package;
            $info[] = Packagename::find($package->packagename_id);
            $info[] = Product::find($package->product_id);
        }

        $array['data'] = $info;

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'packagename_id' => 'min:1',
            'product_id' => 'min:1',
            'price' => 'min:2',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $packagename_id = $request->input('packagename_id');
        $product_id = $request->input('product_id');
        $price = $request->input('price');

        $package = Package::find($id);

        if ($packagename_id) {
            $package->packagename_id = $packagename_id;
        }
        if ($product_id) {
            $package->product_id = $product_id;
        }
        if ($price) {
            $package->price = $price;
        }

        $package->save();

        return $array;
    }
}
