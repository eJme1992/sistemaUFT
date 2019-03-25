<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Db;
use App\Web;

class DbsController extends Controller
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
  return view('layouts.dbs.dbs_create',compact('id'));
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
       
       $validatedData = $request->validate(['dominio' => 'required', 'user' => 'required', 'pass' => 'required']);
       
       
       $Cuenta = Cuenta::where('slug',$request->input('id_Cuenta'))->first();       

      
       $Cuenta->Dbs()->create([
           'dominio'     => $request->input('dominio'),
           'name'     => $request->input('name'),
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
      $Cuenta = Cuenta::where('slug',$slug)->first();
      $db    = Db::where('id',$id)->first();
     return view('layouts.dbs.dbs_edit', compact('db','Cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, Db $Db)
    {
      if ($request->ajax()) {    
        
         $Db->fill($request->except('id_Cuenta'));
         $id = $request->input('id_Cuenta');
         $Db->save();
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

         $var = Web::where('db_id',$id)->first();
         if(count($var)){
           return redirect('Cuentas/'.$slug);
             
         }else{
            
         $Db = Db::where('id',$id)->first();
         $Db->delete();           
         }
          return redirect('Cuentas/'.$slug);
         
    }
}
