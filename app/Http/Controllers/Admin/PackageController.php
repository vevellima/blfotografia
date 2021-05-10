<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageName;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:user-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(5);

        return view('admin.packages.index', [
            'packages' => $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packagenames = PackageName::all();
        $products = Product::all();

        return view('admin.packages.create', [
            'packagenames' => $packagenames,
            'products' => $products
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
            'packagename_id',
            'product_id',
            'price'
        ]);

        $validator = Validator::make($data, [
            'packagename_id' => ['required', 'string', 'min:1'],
            'product_id' => ['required', 'string', 'min:1'],
            'price' => ['required', 'string', 'min:1']
        ]);

        if ($validator->fails()) {
            return redirect()->route('packages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $package = new Package();
        $package->packagename_id = $data['packagename_id'];
        $package->product_id = $data['product_id'];
        $package->price = $data['price'];
        $package->created_at = date('Y-m-d', strtotime(date(now())));
        $package->save();

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);

        if ($package) {
            return view('admin.packages.edit', [
                'package' => $package
            ]);
        }

        return redirect()->route('packages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::find($id);

        if ($package) {
            $data = $request->only([
                'price'
            ]);

            $package->price = $data['price'];

            $package->save();
        }

        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();

        return redirect()->route('packages.index');
    }
}
