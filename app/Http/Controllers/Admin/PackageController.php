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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
