<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Paymentcontrol;
use App\Models\Package;
use App\Models\Packagename;
use App\Models\Product;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(5);
        $users = User::all();
        $paymentcontrols = Paymentcontrol::all();
        $packages = Package::all();
        $packagenames = Packagename::all();
        $products = Product::all();

        return view('admin.services.index', [
            'services' => $services,
            'users' => $users,
            'paymentcontrols' => $paymentcontrols,
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
        $packages = Package::all();
        $users = User::all();

        return view('admin.services.create', [
            'packagenames' => $packagenames,
            'products' => $products,
            'packages' => $packages,
            'users' => $users
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
            'user_id',
            'package_id',
            'payform',
            'day',
            'hours',
            'local',
            'address',
            'neighborhood',
            'city',
            'state'
        ]);

        $validator = Validator::make($data, [
            'user_id' => ['required', 'string'],
            'package_id' => ['required', 'string'],
            'payform' => ['required', 'string'],
            'day' => ['required', 'string'],
            'hours' => ['required', 'string'],
            'local' => ['required', 'string'],
            'address' => ['required', 'string'],
            'neighborhood' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('services.create')
            ->withErrors($validator)
                ->withInput();
        }

        $services = new Service;
        $services->user_id = intval($data['user_id']);
        $services->package_id = intval($data['package_id']);
        $services->payform = intval($data['payform']);
        $services->day = $data['day'];
        $services->hours = $data['hours'];
        $services->local = $data['local'];
        $services->address = $data['address'];
        $services->neighborhood = $data['neighborhood'];
        $services->city = $data['city'];
        $services->state = $data['state'];
        $services->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $services->save();

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
