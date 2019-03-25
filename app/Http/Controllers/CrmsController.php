<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cuenta;
use App\Crm;
use App\Contacto;
use App\Mail;
class CrmsController extends Controller
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
$contactos = Contacto::where('Cuenta_id',$Cuenta->id)->get(); 
return view('layouts.crms.crms_create',compact('id','contactos'));
}
public function mails($id){
$mails = Mail::where('contacto_id',$id)->get();
foreach ($mails as $key) {
echo "
<option value='$key->id'>$key->user</option>
";
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
if ($request->ajax()) {
//validatedData = $request->validate(['nombre' => 'required']);
$Cuenta = Cuenta::where('slug',$request->input('id_cuenta'))->first();       
$Cuenta->crms()->create([
'contacto_id'   => $request->input('contacto_id'),
'mail_id'       => $request->input('mail'),
'seguridad'     => $request->input('seguridad'),
'roles'         => $request->input('roles'),
'user'          => $request->input('user'),
'pass'          => $request->input('pass')     
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
$crm    = Crm::where('id',$id)->first();
$contactos = Contacto::where('Cuenta_id',$Cuenta->id)->get(); 
$mails = Mail::where('contacto_id',$crm->contacto_id)->get(); 
return view('layouts.crms.crms_edit', compact('crm','Cuenta','contactos','mails'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, crm $crm)
{
if ($request->ajax()) {    
$crm->fill($request->except('id_Cuenta'));
$id = $request->input('id_Cuenta');
$crm->save();
return response()->json(['mensaje' => 'Se han editado los datos correctamente', 'status' => 'ok'], 200);
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
$var = Web::where('crm_id',$id)->first();
if(count($var)){
return redirect('Cuentas/'.$slug);
}else{
$crm = crm::where('id',$id)->first();
$crm->delete();           
}
return redirect('Cuentas/'.$slug);
}
}