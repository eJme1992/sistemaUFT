<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
   	protected $fillable = [
            'hosting',
            'plan',
            'url_cpanel',
            'user',
            'pass',
            'cuenta',
            'pin'
   	];

   	 
    public function Cuentas(){
    	return  $this->belongsTo(Cuenta::class);
    }
    public function webs(){
        return  $this->hasMany(Web::class);
    }
     public function ftps(){
        return  $this->hasMany(Ftp::class);
    }
}
