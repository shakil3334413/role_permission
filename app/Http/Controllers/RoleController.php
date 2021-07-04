<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('roles.index')) {
            $roles=Role::all();
            return view('roles.index', compact('roles'));
        }else{
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('roles.create')) {
            $modules=Module::all();
            return view('roles.create', compact('modules'));
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'permissions' => 'required',
            'permissions*'=>'integer',
        ]);

        Role::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),

        ])->permissions()->sync($request->input('permissions'),[]);

        return redirect()->route('roles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        if (Gate::allows('roles.edit')) {
            $modules=Module::all();
            return view('roles.create', compact('modules', 'role'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        if (Gate::allows('roles.delete')) {
       $role->delete();
       return back();
        }else{
            return back();
        }
    }
}
