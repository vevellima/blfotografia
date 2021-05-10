<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $users = User::paginate(5);
        $loggedId = intval(Auth::id());

        return view('admin.users.index', [
            'users' => $users,
            'loggedId' => $loggedId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name',
            'access_level',
            'cpf',
            'cnpj',
            'rg',
            'birthdate',
            'phone',
            'address',
            'neighborhood',
            'city',
            'state',
            'zip_code',
            'email',
            'website',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'access_level' => ['required', 'string', 'max:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->name = $data['name'];
        $user->access_level = $data['access_level'];
        $user->cpf = $data['cpf'];
        $user->cnpj = $data['cnpj'];
        $user->rg = $data['rg'];
        $user->birthdate = $data['birthdate'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->neighborhood = $data['neighborhood'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->zip_code = $data['zip_code'];
        $user->email = $data['email'];
        $user->website = $data['website'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('users.index');
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
        $user = User::find($id);

        if ($user) {
            return view('admin.users.edit', [
                'user' => $user
            ]);
        }

        return redirect()->route('users.index');
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
        $user = User::find($id);

        if ($user) {
            $data = $request->only([
                'name',
                'access_level',
                'cpf',
                'cnpj',
                'rg',
                'birthdate',
                'phone',
                'address',
                'neighborhood',
                'city',
                'state',
                'zip_code',
                'email',
                'website',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'access_level' => $data['access_level'],
                'email' => $data['email'],
            ], [
                'name' => ['required', 'string', 'max:255'],
                'access_level' => ['required', 'string', 'max:1'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            $user->name = $data['name'];
            $user->access_level = $data['access_level'];

            if ($user->email != $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();
                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email',
                    ]));
                }
            }

            if (!empty($data['password'])) {
                if (strlen($data['password']) >= 4) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('users.edit', [
                    'user' => $id
                ])->withErrors($validator);
            }

            $user->save();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = intval(Auth::id());

        if ($loggedId !== intval($id)) {
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}
