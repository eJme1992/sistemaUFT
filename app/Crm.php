<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
	protected $fillable = [ 
            'roles',
            'user',
            'pass',
            'contacto_id',
            'mail_id',
            'seguridad'
	];
	  
    public function cuenta(){
    	return  $this->belongsTo(Cuenta::class);
    }
     public function usuario(){
        return  $this->belongsTo(Usuario::class);
    }
    public function mail(){
        return  $this->belongsTo(Mail::class);
    }
}
