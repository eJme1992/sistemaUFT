<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $fillable = [   'nombre',
            'descripcion',
            'sitio_web',
            'email',
            'usuario',
            'clave',
            'tipo',
            'modalidad',
            'pago',
            'observaciones',
            'fecha_suscripcion',
            'fecha_renovacion',
            'fecha_de_cancelacion',
            'estado'];

  public function getRouteKeyName(){
        return 'id';
    }
         
}
