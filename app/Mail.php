<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
	protected $fillable = [ 
            'mail',
            'user',
            'contacto_id',
            'pass'
	];
	  
    public function Cuentas(){
    	return  $this->belongsTo(Cuenta::class);
    }
}
