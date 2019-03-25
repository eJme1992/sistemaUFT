<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Host;
use App\Web;

class hostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Request $request)
    {
      return $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
  return view('layouts.hosts.hosts_create',compact('id'));
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    if ($request->ajax()) {
       
       /*$validatedData = $request->validate(['host' => 'required', 'user' => 'required', 'pass' => 'required']);*/
       
       
       $Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       


       $Cuenta->hosts()->create([
       
           'hosting'         => $request->input('hosting'),
           'plan'            => $request->input('plan'),
           'url_cpanel'      => $request->input('url_cpanel'),
           'user'            => $request->input('user'),
           'pass'            => $request->input('pass'),
           'cuenta'          => $request->input('cuenta'),
           'pin'             => $request->input('pin')
           
        ]);
      return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
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
    public function edit($slug,$id){
      $Cuenta = Cuenta::where('slug',$slug)->first();
      $host    = host::where('id',$id)->first();
     return view('layouts.hosts.hosts_edit', compact('host','Cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, Host $Host)
    {
      if ($request->ajax()) {    
        
         $Host->fill($request->except('id_Cuenta'));
         $id = $request->input('id_Cuenta');
         $Host->save();
         return response()->json(['mensaje' => 'El registro ha sido editado correctamente', 'status' => 'ok'], 200);

     }

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$slug)
    {
         $var = Web::where('host_id',$id)->first();
         if(count($var)){
           return redirect('Cuentas/'.$slug);
             
         }else{
            
         $Db = Host::where('id',$id)->first();
         $Db->delete();           
         }
          return redirect('Cuentas/'.$slug);
    }
}
