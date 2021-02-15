<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packagename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackagenameController extends Controller
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
        $packagenames = Packagename::paginate(5);

        return view('admin.packagenames.index', [
            'packagenames' => $packagenames
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
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('packagenames.create')
            ->withErrors($validator)
                ->withInput();
        }

        $packagename = new Packagename;
        $packagename->name = $data['name'];
        $packagename->description = $data['description'];
        $packagename->created_at = date('Y-m-d H:i:s', strtotime(now()));
        $packagename->save();

        return redirect()->route('packagenames.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Packagename  $packagename
     * @return \Illuminate\Http\Response
     */
    public function show(Packagename $packagename)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Packagename  $packagename
     * @return \Illuminate\Http\Response
     */
    public function edit(Packagename $packagename)
    {
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
     * @param  \App\Models\Packagename  $packagename
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packagename $packagename)
    {
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
                'description' => ['required', 'string'],
            ]);

            if ($packagename->name != $data['name']) {
                $packagename->name = $data['name'];
            }

            if ($packagename->description != $data['description']) {
                $packagename->description = $data['description'];
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('packagenames.edit', [
                    'packagename' => $packagename
                ])->withErrors($validator);
            }

            $packagename->save();
        }

        return redirect()->route('packagenames.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Packagename  $packagename
     * @return \Illuminate\Http\Response
     */
    public function destroy(Packagename $packagename)
    {
        $packagename->delete();

        return redirect()->route('packagenames.index');
    }
}
