<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Social;

class SocialesController extends Controller
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
  return view('layouts.sociales.sociales_create',compact('id'));
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
       
       $validatedData = $request->validate(['nombre' => 'required', 'user' => 'required', 'pass' => 'required']);
       
       
       $Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       

       $Cuenta->sociales()->create([
           'nombre'     => $request->input('nombre'),
           'url'     => $request->input('url'),
           'user'     => $request->input('user'),
           'pass'     => $request->input('pass')
           
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
      $Cuenta     = Cuenta::where('slug',$slug)->first();
      $sociales    = Social::where('id',$id)->first();
     return view('layouts.sociales.sociales_edit', compact('sociales','Cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request)
    {
      if ($request->ajax()) {    
         $Social   = Social::where('id',$request->input('id'))->first();
         $Social->nombre = $request->input('nombre'); 
         $Social->user = $request->input('user'); 
         $Social->pass = $request->input('pass'); 
         $Social->save();
         return response()->json(['mensaje' => 'La red social fue editada correctamente', 'status' => 'ok'], 200);
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
         $sociales = Social::where('id',$id)->first();
         $sociales->delete();
         return redirect('Cuentas/'.$slug);
    }
}
