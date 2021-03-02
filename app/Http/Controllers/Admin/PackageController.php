<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Packagename;
use App\Models\Product;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(5);
        $packagenames = Packagename::all();
        $products = Product::all();

        return view('admin.packages.index', [
            'packages' => $packages,
            'packagenames' => $packagenames,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packagenames = Packagename::all();
        $products = Product::all();

        return view('admin.packages.create', [
            'packagenames' => $packagenames,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'price',
            'packagename_id',
            'product_id'
        ]);

        $validator = Validator::make($data, [
            'price' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('packages.create')
            ->withErrors($validator)
                ->withInput();
        }

        $package = new Package;
        $package->price = intval($data['price']);
        $package->packagename_id = $data['packagename_id'];
        $package->product_id = $data['product_id'];
        $package->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $package->save();

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        if ($package) {

            $packagenames = Packagename::all();
            $products = Product::all();

            return view('admin.packages.edit', [
                'package' => $package,
                'packagenames' => $packagenames,
                'products' => $products
            ]);
        }

        return redirect()->route('packages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        if ($package) {
            $data = $request->only([
                'price',
                'packagename_id',
                'product_id'
            ]);

            $validator = Validator::make([
                'price' => $data['price'],
            ], [
                'price' => ['required', 'string'],
            ]);

            if (count($validator->errors()) > 0) {
                return redirect()->route('products.edit', [
                    'package' => $package
                ])->withErrors($validator);
            }

            if ($package->price != $data['price']) {
                $package->price = intval($data['price']);
            }

            if ($package->packagename_id != $data['packagename_id']) {
                $package->packagename_id = intval($data['packagename_id']);
            }

            if ($package->product_id != $data['product_id']) {
                $package->product_id = intval($data['product_id']);
            }

            $package->save();
        }

        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index');
    }
}
