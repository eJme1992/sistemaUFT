<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Software;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Software = Software::all();
        return view('layouts.software.software', compact('Software'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('layouts.software.software_create', compact('Software'));
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
             
             $Software = new Software();

             if($request->input('tipo')=='Gratis'){
             $Software->modalidad = '-';
             $Software->pago = '-';
             }else{
             $Software->modalidad = $request->input('modalidad');
             $Software->pago = $request->input('pago');
             }

             $Software->nombre = $request->input('nombre');
             $Software->descripcion = $request->input('descripcion');
             $Software->sitio_web = $request->input('sitio_web');
             $Software->email = $request->input('email');
             $Software->usuario = $request->input('usuario');
             $Software->clave = $request->input('clave');
             $Software->tipo = $request->input('tipo');
             $Software->fecha_de_cancelacion = $request->input('fecha_de_cancelacion');
      
             $Software->observaciones = $request->input('observaciones');
             $Software->fecha_suscripcion = $request->input('fecha_suscripcion');
             $Software->fecha_renovacion = $request->input('fecha_renovacion');
             $Software->estado = $request->input('estado');

             $Software->save();

             return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Software $Software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $Software)
    {
       return view('layouts.software.software_edit', compact('Software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $Software)
    {
     if ($request->ajax()) {
            $Software->fill($request->except('fecha_de_cancelacion'));         
            $Software->save();
            return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $Software)
    {
        $Software->delete();
        return redirect('software');
    }


      public function baja(Request $request) {
       $Software = Software::where('id', $request->input('id'))->first();
        if ($Software->estado == 'activo') {
            $Software->estado = 'inactivo';
            $Software->fecha_de_cancelacion = date("Y-m-d H:i:s");
           
        } else {
            $Software->estado = 'activo';
            $Software->fecha_de_cancelacion = " ";
        }
        $Software->save();
        return redirect('software');
    }
}
