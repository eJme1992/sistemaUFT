<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    protected $fillable = [
    	    'host_id',
            'db_id',
            'tipo',
            'tipo_p',
            'pago',
            'url',
            'url_admin',
            'user',
            'pass'
             ];

     
 
    public function host(){
    	return  $this->belongsTo(Host::class);
    }
    public function db(){
    	return  $this->belongsTo(Db::class);
    }
}
