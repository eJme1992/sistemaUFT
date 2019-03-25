<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Host;
use App\Cuenta;
use App\Ftp;

class FtpsController extends Controller
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
       return view('layouts.ftps.ftps_create',compact('id','hosts'));
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
       
       /*$validatedData = $request->validate(['ftp' => 'required', 'user' => 'required', 'pass' => 'required']);*/
      //Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       
       $host = Host::where('id',$request->input('host_id'))->first();  

     $host->ftps()->create([
           'carpeta'      => $request->input('carpeta'),
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
     //  $dbs = Db::where('Cuenta_id',$Cuenta->id)->get(); 
      $ftp    = Ftp::where('id',$id)->first();
     return view('layouts.ftps.ftps_edit', compact('ftp','Cuenta','hosts','dbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request,ftp $ftp)
    {
      if ($request->ajax()) { 

$ftp->fill($request->except('id'));
            $id = $request->input('id_Cuenta');
        if ($ftp->db_id==$request->input('db_id')) {
          
         $ftp->save();
          return response()->json(['mensaje' => 'Se han editado los datos correctamente', 'status' => 'ok'], 200);
        }else{
          $ftp2    = ftp::where('db_id',$request->input('db_id'))->first();
          if(count($ftp2)){
              return response()->json(['mensaje' => 'Lo sentimos esta base de datos esta siendo usada por otra ftp', 'status' => '0'], 200);
          }else{
            
            $ftp->save();
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
         $ftp = Ftp::where('id',$id)->first();
         $ftp->delete();
        return redirect('cuentas/'.$slug);
    }
}



