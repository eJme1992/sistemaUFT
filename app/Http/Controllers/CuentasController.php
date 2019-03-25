<?php
namespace App\Http\Controllers;
use App\Cuenta;
use App\Contacto;
use App\Web;
use App\Host;
use App\Crm;
use App\Ftp;
use App\Mail;

use Storage;
use App\Imports\CuentasImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CuentasController extends Controller {
    public function __construct(Request $request) {
        return $this->middleware('auth');
    }
    public function index(Request $request) {
        //$request->user()->AutorizarRoles(['admin'],['user']);
        $Cuentas = Cuenta::all();
        return view('layouts.cuentas.cuentas', compact('Cuentas'));
    }
    public function create() {
        return view('layouts.cuentas.cuentas_create', compact('Cuentas'));
    }
    public function store(Request $request) {
        if ($request->ajax()) {
            // return dd($d);
            $validatedData = $request->validate(['logo' => 'required|image', 'nombrec' => 'required', 'tipo' => 'required', 'industria' => 'required', 'tema' => 'required', 'referido' => 'required', 'crm' => 'required', 'descripcion' => 'required', 'calle' => 'required', 'ciudad' => 'required', 'provincia' => 'required', 'pais' => 'required', 'codigo_postal' => 'required', 'correoc' => 'required', 'telefonoc' => 'required', ]);
            $Cuenta = new Cuenta();
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $name = time() . $file->getClientOriginalName();
                $name = str_replace(' ', '', $name);
                $name = $Cuenta->limpiarCaracteresEspeciales($name);
                $file->move(public_path() . '/img/programa/', $name);
            }
            $Cuenta->nombre = $request->input('nombrec');
            $Cuenta->tipo = $request->input('tipo');
            $Cuenta->industria = $request->input('industria');
            $Cuenta->tema = $request->input('tema');
            $Cuenta->referido = $request->input('referido');
            $Cuenta->crm = $request->input('crm');
            $Cuenta->logo = $name;
            $Cuenta->descripcion = $request->input('descripcion');
            $Cuenta->calle = $request->input('calle');
            $Cuenta->ciudad = $request->input('ciudad');
            $Cuenta->provincia = $request->input('provincia');
            $Cuenta->pais = $request->input('pais');
            $Cuenta->codigo_postal = $request->input('codigo_postal');
            $Cuenta->correo = $request->input('correoc');
            $Cuenta->telefono = $request->input('telefonoc');
            $Cuenta->estado = 'activo';
            $Cuenta->slug = uniqid($request->input('nombrec'));
            $Cuenta->save();
            $Cuenta->contactos()->create(['estado' => 'activo', 'nombre' => $request->input('nombre'), 'apellido' => $request->input('apellido'), 'cargo' => $request->input('cargo'), 'tipo' => 'principal', 'telefono' => $request->input('telefono') ]);
            return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
        }
    }
    public function show(Cuenta $Cuenta) {
        $user = Contacto::where('tipo', 'principal')->where('cuenta_id', $Cuenta->id)->first();
        $Cuenta = Cuenta::findOrFail($Cuenta->id);
        $contactos = $Cuenta->contactos;
        $hosts = $Cuenta->hosts;
        //  $mails = $Cuenta->mails;
        $dbs = $Cuenta->dbs;
        $sociales = $Cuenta->sociales;
        
        $webs = Web::join('hosts', 'hosts.id', '=', 'webs.host_id')->join('dbs', 'dbs.id', '=', 'webs.db_id')->join('cuentas', 'cuentas.id', '=', 'hosts.cuenta_id')->select('webs.*', 'hosts.url_cpanel', 'dbs.name')->where('hosts.cuenta_id', $Cuenta->id)->get();

        $mails = Mail::join('contactos', 'contactos.id', '=', 'mails.contacto_id')->join('cuentas', 'cuentas.id', '=', 'mails.cuenta_id')->select('mails.*', 'contactos.nombre', 'contactos.apellido')->where('mails.cuenta_id', $Cuenta->id)->get();

        $ftps = Ftp::join('hosts', 'hosts.id', '=', 'ftps.host_id')->join('cuentas', 'cuentas.id', '=', 'hosts.cuenta_id')->select('ftps.*', 'hosts.url_cpanel')->where('hosts.cuenta_id', $Cuenta->id)->get();

        $crms = Crm::join('cuentas', 'cuentas.id', '=', 'crms.cuenta_id')->join('contactos', 'contactos.id', '=', 'crms.contacto_id')->join('mails', 'mails.id', '=', 'crms.mail_id')->select('crms.*', 'contactos.nombre','contactos.apellido','mails.user as user_email')->where('crms.cuenta_id', $Cuenta->id)->get();
        return view('layouts.cuentas.cuentas_view', compact('Cuenta', 'user', 'contactos', 'hosts', 'mails', 'dbs', 'sociales', 'webs', 'crms','ftps'));
    }
    public function edit(Cuenta $Cuenta) {
        return view('layouts.cuentas.cuentas_edit', compact('Cuenta'));
    }
    public function update(Request $request, Cuenta $Cuenta) {
        if ($request->ajax()) {
            $Cuenta->fill($request->except('logo'));
            /* $user = contacto::findOrFail($Cuenta->id)->where('tipo','principal')->first();
            $user->tipo = 'standar';
            $user->save();*/
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $name = time() . $file->getClientOriginalName();
                $name = str_replace(' ', '', $name);
                $name = $Cuenta->limpiarCaracteresEspeciales($name);
                //$name = str_replace(' ', '', $Cuenta->logo);
                $Cuenta->logo = $name;
                $file->move(public_path() . '/img/programa/', $name);
            }
            $Cuenta->save();
            //$Cuentas = Cuenta::find(1);
            return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
        }
    }
    public function destroy(Cuenta $Cuenta) {
        $file_path = public_path() . '/img/programa/' . $Cuenta->logo;
        \File::delete($file_path);
        $Cuenta->delete();
        return redirect('cuentas');
    }
    public function baja(Request $request) {
        $Cuenta = Cuenta::where('slug', $request->input('slug'))->first();
        if ($Cuenta->estado == 'activo') {
            $Cuenta->estado = 'inactivo';
            $Cuenta->baja = $request->input('baja');
        } else {
            $Cuenta->estado = 'activo';
        }
        $Cuenta->save();
        return redirect('cuentas');
    }
    public function cargar_datos_cuentas(Request $request) {
        $archivo = $request->file('excel');
    if ($archivo->getClientOriginalExtension() != 'csv') {
    return response()->json(['mensaje' => 'El archivo debe ser formato CSV', 'status' => '0'], 200);
        }
        $nombre_original = time() . $archivo->getClientOriginalName();
        $nombre_original = str_replace(' ', '', $nombre_original);
        $archivo->move(storage_path('app/public') . '/', $nombre_original);
        //hasta aqui el guardado
        //ahora lo recuperamos para poder trabajar en el
        $ruta = storage_path('app/public') . '/' . $nombre_original;
        if (file_exists($ruta)) {
            $ct = 0;
            $fichero = fopen($ruta, "r");
            $x = 0;
            while (($datos = fgetcsv($fichero, 290000)) != FALSE) {
                $x++;
                if ($x > 1) {
                    if (($datos[0] !== NULL) and ($datos[0] !== '') and (isset($datos[17]))) {
                        $Cuenta = new Cuenta();
                        $Cuenta->nombre = utf8_encode($datos[0]);
                        $Cuenta->tipo = utf8_encode($datos[1]);
                        $Cuenta->industria = utf8_encode($datos[2]);
                        $Cuenta->tema = utf8_encode($datos[3]);
                        $Cuenta->referido = utf8_encode($datos[4]);
                        $Cuenta->crm = utf8_encode($datos[5]);
                        $Cuenta->descripcion = utf8_encode($datos[6]);
                        $Cuenta->calle = utf8_encode($datos[7]);
                        $Cuenta->ciudad = utf8_encode($datos[8]);
                        $Cuenta->provincia = utf8_encode($datos[9]);
                        $Cuenta->pais = utf8_encode($datos[10]);
                        $Cuenta->codigo_postal = utf8_encode($datos[11]);
                        $Cuenta->correo = utf8_encode($datos[12]);
                        $Cuenta->telefono = utf8_encode($datos[13]);
                        $Cuenta->logo = '/';
                        $Cuenta->estado = 'activo';
                        $Cuenta->slug = uniqid(utf8_encode($datos[0]));
                        $Cuenta->save();
                        $Cuenta->contactos()->create(['estado' => 'activo', 'nombre' => utf8_encode($datos[14]), 'apellido' => utf8_encode($datos[15]), 'cargo' => utf8_encode($datos[16]), 'tipo' => 'principal', 
                            'telefono' => utf8_encode($datos[17])                            ]);
                    } else {
                        return response()->json(['mensaje' => 'El archivo no tiene el formato pedido', 'status' => '0'], 200);
                    }
                }
            }
            return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
        } else {
            return response()->json(['mensaje' => 'Error a subir el archivo', 'status' => 'ok'], 200);
        }
    }
}
