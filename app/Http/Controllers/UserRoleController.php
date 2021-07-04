<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('users.index')){
            $users=User::all();
            return view('users.index',compact('users'));
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
        if(Gate::allows('users.create')){
        $roles=Role::all();
        return view('users.create',compact('roles'));
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
            'name' => ['required', 'string', 'max:20','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
            'description' => ['min:15', 'max:300'],
            'role_id'=>['required'],
        ]);

        User::create([
            'name' =>$request->name,
            'role_id'=>$request->role_id,
            'email' =>$request->email,
            'description' =>$request->description,
            'password' => Hash::make($request->password),
            'is_active'=>$request->is_active,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::allows('users.edit')) {
            $roles=Role::all();
            return view('users.create', compact('roles', 'user'));
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required','string', 'max:20','unique:users,name,'.$user->id,
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users,name,'.$user->id,
            'password' =>'nullable','string', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'description' => ['min:15', 'max:300'],
            'role_id'=>['required'],
        ]);
    $user->update([
            'name' =>$request->name,
            'role_id'=>$request->role_id,
            'email' =>$request->email,
            'description' =>$request->description,
            'password' =>isset($request->password) ? Hash::make($request->password) : $user->password,
            'is_active'=>$request->is_active,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::allows('users.delete')) {
            $user->delete();
            return back();
        }else{
            return back();
        }
    }
}
