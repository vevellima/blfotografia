<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Typepackage;


class TypePackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typepackages = Typepackage::paginate(5);

        return view('admin.typepackages.index', [
            'typepackages' => $typepackages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typepackages.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:products']
        ]);

        if ($validator->fails()) {
            return redirect()->route('typepackages.create')
            ->withErrors($validator)
                ->withInput();
        }

        $typepackage = new Typepackage;
        $typepackage->name = $data['name'];
        $typepackage->description = $data['description'];
        $typepackage->created_at = date('Y-m-d H:i:s', strtotime(date(now())));
        $typepackage->save();

        return redirect()->route('typepackages.index');
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
        $typepackage = Typepackage::find($id);

        if ($typepackage) {
            return view('admin.typepackages.edit', [
                'typepackage' => $typepackage
            ]);
        }

        return redirect()->route('typepackages.index');
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
        $typepackage = Typepackage::find($id);

        if ($typepackage) {
            $data = $request->only([
                'name',
                'description'
            ]);

            $typepackage->name = $data['name'];
            $typepackage->description = $data['description'];
            $typepackage->created_at = date('Y-m-d H:i:s', strtotime(date(now())));
            $typepackage->save();
        }

        return redirect()->route('typepackages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typepackage = Typepackage::find($id);
        $typepackage->delete();

        return redirect()->route('typepackages.index');
    }
}
