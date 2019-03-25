<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

	protected $fillable = ['nombre','apellido','cargo','tipo','estado','telefono'];
    public function Cuentas(){
    	return  $this->belongsTo(Cuenta::class);
    }
      public function getRouteKeyName(){
        return 'id';
    }
}
