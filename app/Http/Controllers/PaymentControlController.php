<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PaymentControl;
use App\Models\PaymentForm;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;

class PaymentControlController extends Controller
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

        $paymentform_id = $request->input('paymentform_id');
        $portion = $request->input('portion');
        $value_pay = $request->input('value_pay');


        $newPaymentControl = new PaymentControl();
        $newPaymentControl->paymentform_id = $paymentform_id;
        $newPaymentControl->portion = $portion;
        $newPaymentControl->date_pay = date('Y-m-d H:i:s', strtotime(now()));
        $newPaymentControl->value_pay = $value_pay;
        $newPaymentControl->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $newPaymentControl->save();

        return $array;
    }

    public function read(Request $request)
    {
        $array = ['error' => ''];

        $id = $request->input('id');

        $info = [];

        $paymentcontrol = PaymentControl::find($id);
        $info[] = $paymentcontrol;

        $paymentform = PaymentForm::find($paymentcontrol->paymentform_id);
        $info[] = $paymentform;

        $service = Service::find($paymentform->service_id);
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

        $paymentcontrols = PaymentControl::all();
        $info = [];

        foreach ($paymentcontrols as $paymentcontrol) {
            $info[] = $paymentcontrol;

            $paymentform = PaymentForm::find($paymentcontrol->paymentform_id);
            $info[] = $paymentform;

            $service = Service::find($paymentform->service_id);
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
            'paymentform_id' => 'min:1',
            'portion' => 'min:1',
            'value_pay' => 'min:1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $id =  $request->input('id');
        $paymentform_id =  $request->input('paymentform_id');
        $portion = $request->input('portion');
        $value_pay = $request->input('value_pay');

        $paymentcontrol = PaymentControl::find($id);

        if ($paymentform_id) {
            $paymentcontrol->paymentform_id = $paymentform_id;
        }
        if ($portion) {
            $paymentcontrol->portion = $portion;
        }
        if ($value_pay) {
            $paymentcontrol->value_pay = $value_pay;
        }

        $paymentcontrol->save();

        return $array;
    }
}
