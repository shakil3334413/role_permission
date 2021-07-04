<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('permissions.index')) {
            $permissions=Permission::all();
            return view('permissions.index', compact('permissions'));
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
        if (Gate::allows('permissions.create')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules'));
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
            'name' => ['required', 'string','unique:permissions'],
            'slug' => ['string','unique:permissions'],
            'module_id'=>['required'],
        ]);

        Permission::create([
            'name' =>$request->name,
            'module_id'=>$request->module_id,
            'slug' =>$request->slug ?? Str::slug($request->name),
        ]);

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        if (Gate::allows('permissions.edit')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules', 'permission'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required', 'string','unique:permissions,name'.$permission->id,
            'slug' => 'required', 'string','unique:permissions,slug,'.$permission->id,
            'module_id'=>['required'],
        ]);
    $permission->update([
            'name' =>$request->name,
            'module_id'=>$request->module_id,
            'slug' =>$request->slug ?? Str::slug($request->name),
        ]);

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (Gate::allows('permissions.delete')) {
            $permission->delete();
            return back();
        }else{
            return back();
        }
    }
}
