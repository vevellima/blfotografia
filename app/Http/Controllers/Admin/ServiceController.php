<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Package;
use App\Models\PaymentForm;
use App\Models\Packagename;
use App\Models\PackageProduct;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
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
        $services = Service::paginate(5);

        return view('admin.services.index', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $packages = Package::all();

        return view('admin.services.create', [
            'users' => $users,
            'packages' => $packages
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
            'state',
        ]);

        $validator = Validator::make($data, [
            'user_id' => ['required', 'string', 'min:1'],
            'package_id' => ['required', 'string', 'min:1'],
            'payform' => ['required', 'string', 'min:1'],
            'day' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'local' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'neighborhood' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()->route('services.create')
                ->withErrors($validator)
                ->withInput();
        }

        $service = new Service();
        $service->user_id = $data['user_id'];
        $service->package_id = $data['package_id'];
        $service->payform = $data['payform'];
        $service->day = $data['day'];
        $service->hours = $data['hours'];
        $service->local = $data['local'];
        $service->address = $data['address'];
        $service->neighborhood = $data['neighborhood'];
        $service->city = $data['city'];
        $service->state = $data['state'];
        $service->created_at = date('Y-m-d', strtotime(date(now())));
        $service->save();

        if ($data['payform']) {
            $serv = Service::all()->last();
            for ($i = 1; $i <= $data['payform']; $i++) {
                $dias = $i * 30;
                $payment = new PaymentForm();
                $payment->service_id = $serv['id'];
                $payment->portion = $i;
                $payment->due_date = date('Y-m-d', strtotime('+' . $dias . 'days', strtotime(date(now()))));
                $payment->created_at = date('Y-m-d', strtotime(date(now())));
                $payment->save();
            }
        }

        return redirect()->route('services.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
