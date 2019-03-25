<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Db extends Model
{
   	protected $fillable = ['dominio','name','user','pass'];
    public function Cuentas(){
    	return  $this->belongsTo(Cuenta::class);
    }
}
