<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Contacto;
use App\Mail;

class MailsController extends Controller
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

  $Cuenta = Cuenta::where('slug',$id)->first();  
  $usuarios = Contacto::where('Cuenta_id',$Cuenta->id)->get(); 

  return view('layouts.mails.mails_create',compact('id','usuarios'));
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
       
       $validatedData = $request->validate(['mail' => 'required', 'user' => 'required', 'pass' => 'required']);
       
       
       $Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       


       $Cuenta->mails()->create([
           'contacto_id'     => $request->input('contacto_id'),
           'mail'            => $request->input('mail'),
           'user'            => $request->input('user'),
           'pass'            => $request->input('pass')
           
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
      $contactos = $Cuenta->contactos;
      $mail    = Mail::where('id',$id)->first();
     return view('layouts.mails.mails_edit', compact('mail','Cuenta','contactos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, mail $mail)
    {
      if ($request->ajax()) {    
        
         $mail->fill($request->except('id_Cuenta'));
         $id = $request->input('id_Cuenta');
         $mail->save();
         return response()->json(['mensaje' => 'El mail a sido editado correctamente', 'status' => 'ok'], 200);
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
         $mail = Mail::where('id',$id)->first();
         $mail->delete();
        return redirect('Cuentas/'.$slug);
    }
}
