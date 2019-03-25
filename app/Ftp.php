<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftp extends Model
{
	    protected $fillable = [
    	    'host_id',
            'carpeta',
            'user',
            'pass'
             ];

     public function host(){
    	return  $this->belongsTo(Host::class);
    }
}
