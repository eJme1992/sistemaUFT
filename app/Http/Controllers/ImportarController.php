<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cuenta;
use App\Crm;
use App\Contacto;
use App\Mail;
class ImportarController extends Controller
{

public function __construct(Request $request)
{
return $this->middleware('auth');
}

public function index()
{
    return view('layouts.importar.importar_create');
}
}