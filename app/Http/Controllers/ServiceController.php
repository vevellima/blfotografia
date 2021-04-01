<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\Package;
use App\Models\PackageName;
use App\Models\Product;
use App\Models\User;
use App\Models\PaymentForm;

class ServiceController extends Controller
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

        $user_id = $request->input('user_id');
        $package_id = $request->input('package_id');
        $payform = $request->input('payform');
        $day = $request->input('day');
        $hours = $request->input('hours');
        $local = $request->input('local');
        $address = $request->input('address');
        $neighborhood = $request->input('neighborhood');
        $city = $request->input('city');
        $state = $request->input('state');

        $newService = new Service();
        $newService->user_id = $user_id;
        $newService->package_id = $package_id;
        $newService->payform = $payform;
        $newService->day = date('Y-m-d', strtotime($day));
        $newService->hours = $hours;
        $newService->local = $local;
        $newService->address = $address;
        $newService->neighborhood = $neighborhood;
        $newService->city = $city;
        $newService->state = $state;
        $newService->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $newService->save();

        $service = Service::all()->last();

        for ($i = 1; $i <= $payform; $i++) {
            $days = 31 * $i;
            $newPayForm = new PaymentForm();
            $newPayForm->service_id = $service->id;
            $newPayForm->portion = $i;
            $newPayForm->date_pay = date('Y-m-d', strtotime(now() . ' + ' . $days . ' days'));
            $newPayForm->created_at = date('Y-m-d H:i:s', strtotime(now()));
            $newPayForm->save();
        }

        return $array;
    }

    public function read(Request $request)
    {
        $array = ['error' => ''];

        $id = $request->input('id');

        $info = [];
        $service = Service::find($id);

        $info[] = $service;

        $user = User::find($service->user_id);
        $info[] = $user;

        $package = Package::find($service->package_id);
        $info[] = $package;

        $info[] = PackageName::find($package->packagename_id);
        $info[] = Product::find($package->product_id);

        $array['data'] = $info;

        return $array;
    }

    public function list()
    {
        $array = ['error' => ''];

        $services = Service::all();
        $info = [];

        foreach ($services as $service) {
            $info[] = $service;
            $user = User::find($service->user_id);
            $info[] = $user;
            $package = Package::find($service->package_id);
            $info[] = $package;
            $info[] = PackageName::find($package->packagename_id);
            $info[] = Product::find($package->product_id);
        }

        $array['data'] = $info;

        return $array;
    }

    public function update(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'user_id' => 'min:1',
            'package_id' => 'min:1',
            'payform' => 'max:1',
            'day' => 'max:5',
            'hours' => 'max:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $package_id = $request->input('package_id');
        $day = $request->input('day');
        $hours = $request->input('hours');
        $local = $request->input('local');
        $address = $request->input('address');
        $neighborhood = $request->input('neighborhood');
        $city = $request->input('city');
        $state = $request->input('state');

        $service = Service::find($id);

        if ($package_id) {
            $service->package_id = $package_id;
        }
        if ($day) {
            $service->day = $day;
        }
        if ($hours) {
            $service->hours = $hours;
        }
        if ($local) {
            $service->local = $local;
        }
        if ($address) {
            $service->address = $address;
        }
        if ($neighborhood) {
            $service->neighborhood = $neighborhood;
        }
        if ($city) {
            $service->city = $city;
        }
        if ($state) {
            $service->state = $state;
        }

        $service->save();

        return $array;
    }
}
