<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class UsuariossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Usuarios = User::join('role_user', 'role_user.user_id', '=', 'users.id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('users.*', 'roles.name AS role')->get();

        return view('layouts.user.user', compact('Usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('layouts.user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $Request)
    {
           if ($Request->ajax()){
           $User = new User();
           $role = Role::where('id',$Request->input('tipo'))->first();

           $User->name     = $Request->input('name');
           $User->password = bcrypt($Request->input('password')); 
           $User->email    = $Request->input('email');
        
           $User->save();
           $User->roles()->attach($role);
           
           return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
            /*$User = User::where('id', $id)->first();
            $User ->fill($request->all());     
            $User->save();
            return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);*/
        }
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
        $Usuarios = User::join('role_user', 'role_user.user_id', '=', 'users.id')->join('roles', 'roles.id', '=', 'role_user.role_id')->select('users.*','roles.id AS id_role', 'roles.name AS role')->where('users.id',$id)->first();
        return view('layouts.user.user_edit', compact('Usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if ($request->ajax()) {
            $User   = User::where('id', $id)->first();
         
            if ($request->has('tipo')) {
              $role   = Role::where('id',$request->input('tipo'))->first();
              $roleId = Role::where('id',$request->input('tv'))->first();  
              $User->fill($request->except('tipo','password'));
              $User->save();
              $User->roles()->detach($roleId);
              $User->roles()->attach($role);
            }else{
              $User->password = bcrypt($request->input('password')); 
              $User->save();
            }
            
            
          
    
            return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::where('id', $id)->first();
        $User->delete();
        return redirect('usuarios');
    }
}
