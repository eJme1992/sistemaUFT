<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Contacto;

class ContactosController extends Controller
{
   public function __construct(Request $request)
    {
      return $this->middleware('auth');
    }
    
 public function create($id){
  return view('layouts.contacto.contactos_create',compact('id'));
  }

  public function store(Request $request){
    if ($request->ajax()) {
       
       $validatedData = $request->validate(['nombre' => 'required', 'apellido' => 'required', 'tipo' => 'required',  'telefono' => 'required', ]);
       
       
       $Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();
       $id =  $Cuenta->id;

       if($request->input('tipo') == 'Principal'){ 
       $user = contacto::where('tipo','Principal')->where('Cuenta_id',$id)->first();
       if($user!=null){
       $user->tipo = 'Secundario';
       $user->save();}
       }
       $Cuenta = Cuenta::where('id',$id)->first();
       


       $Cuenta->contactos()->create([
           'nombre'     => $request->input('nombre'),
           'apellido'   => $request->input('apellido'),
           'cargo'      => $request->input('cargo'),
           'tipo'       => $request->input('tipo'),
           'estado'     => 'activo',
           'telefono'   => $request->input('telefono'),
        ]);
      return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
    }
  }

    public function edit($slug,$id){
      $Cuenta = Cuenta::where('slug',$slug)->first();
      $contacto = contacto::where('id',$id)->first();
     return view('layouts.contacto.contactos_edit', compact('contacto','Cuenta'));
    }

    public function update(Request $request, contacto $contacto)
    {
      if ($request->ajax()) {    
        $contacto->fill($request->except('id_Cuenta'));
        $id = $request->input('id_Cuenta');

        if($request->input('tipo') == 'Principal'){

        $user = contacto::where('tipo','Principal')->where('Cuenta_id',$id)->first();

        if($user!=null){
        $user->tipo = 'Secundario';
        $user->save();

        }
       

        }else{
         $var= contacto::where('tipo','Principal')->where('id',$contacto->id)->first();

         if($var!=null){ 
         return response()->json(['error' => 'Este contacto es Principal debe escoger a otro contacto como Principal para que este sea Secundario', 'status' => '0'], 200);
         }

        }




        $contacto->save();

        // $contactos = contacto::find(1);

        return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
      }
    }

    public function destroy($id,$slug)
    {
      $Cuenta = Cuenta::where('slug',$slug)->first();  
      $contacto = contacto::where('id',$id)->first();
      if($contacto->tipo == 'Principal'){
        $user = contacto::where('tipo','Secundario')->where('Cuenta_id',$Cuenta->id)->first();
        if(count($user)){
        $user->tipo = 'Principal';
        $user->save();
        }else{
        return redirect('Cuentas/'.$slug);
        }
        }
        $contacto->delete();
        return redirect('Cuentas/'.$slug);
    }
}
