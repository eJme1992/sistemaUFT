<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Web;
use App\Host;
use App\Db;

class websController extends Controller
{
   public function __construct(Request $request)
    {
      return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
       //$Cuenta = Cuenta::findOrFail($id);
       //$dbs = $Cuenta->dns;
       $hosts = Host::where('Cuenta_id',$Cuenta->id)->get();  
       $dbs = Db::where('Cuenta_id',$Cuenta->id)->get(); 
       return view('layouts.webs.webs_create',compact('id','hosts','dbs'));
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
       
       /*$validatedData = $request->validate(['web' => 'required', 'user' => 'required', 'pass' => 'required']);*/
      //Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       
       $host = Host::where('id',$request->input('hosting_id'))->first();  



     $host->webs()->create([
           'db_id'        => $request->input('db_id'),
           'url'          => $request->input('url'),
           'url_admin'    => $request->input('url_admin'),
           'tipo'         => $request->input('tipo'),
           'tipo_p'       => $request->input('tipo_p'),
           'pago'         => $request->input('pago'),
           'user'         => $request->input('user'),
           'pass'         => $request->input('pass')    
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
        //$Cuenta = Cuenta::findOrFail($id);
       //$dbs = $Cuenta->dns;
       $hosts = Host::where('Cuenta_id',$Cuenta->id)->get();  
       $dbs = Db::where('Cuenta_id',$Cuenta->id)->get(); 
      $web    = web::where('id',$id)->first();
     return view('layouts.webs.webs_edit', compact('web','Cuenta','hosts','dbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request,Web $Web)
    {
      if ($request->ajax()) { 

$Web->fill($request->except('id'));
            $id = $request->input('id_Cuenta');
        if ($Web->db_id==$request->input('db_id')) {
          
         $Web->save();
          return response()->json(['mensaje' => 'Se han editado los datos correctamente', 'status' => 'ok'], 200);
        }else{
          $web2    = web::where('db_id',$request->input('db_id'))->first();
          if(count($web2)){
              return response()->json(['mensaje' => 'Lo sentimos esta base de datos esta siendo usada por otra web', 'status' => '0'], 200);
          }else{
            
            $Web->save();
            return response()->json(['mensaje' => 'Se han editado los datos correctamente', 'status' => 'ok'], 200);
          }

        }


      
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
         $web = web::where('id',$id)->first();
         $web->delete();
        return redirect('Cuentas/'.$slug);
    }
}
