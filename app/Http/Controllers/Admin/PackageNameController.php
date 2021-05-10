<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageName;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PackageNameController extends Controller
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
        $packagenames = PackageName::paginate(5);

        return view('admin.packagenames.index', [
            'packagenames' => $packagenames,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packagenames.create');
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
            'description'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()->route('packagenames.create')
                ->withErrors($validator)
                ->withInput();
        }

        $packagename = new PackageName();
        $packagename->name = $data['name'];
        $packagename->description = $data['description'];
        $packagename->created_at = date('Y-m-d', strtotime(date(now())));
        $packagename->save();

        return redirect()->route('packagenames.index');
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
        $packagename = PackageName::find($id);

        if ($packagename) {
            return view('admin.packagenames.edit', [
                'packagename' => $packagename
            ]);
        }

        return redirect()->route('packagenames.index');
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
        $packagename = PackageName::find($id);

        if ($packagename) {
            $data = $request->only([
                'name',
                'description'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'description' => $data['description'],
            ], [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255']
            ]);

            if (count($validator->errors()) > 0) {
                return redirect()->route('packagenames.edit', [
                    'packagename' => $id
                ])->withErrors($validator);
            }

            $packagename->name = $data['name'];
            $packagename->description = $data['description'];

            $packagename->save();
        }

        return redirect()->route('packagenames.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packagename = PackageName::find($id);
        $packagename->delete();

        return redirect()->route('packagenames.index');
    }
}
