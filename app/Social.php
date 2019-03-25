<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['nombre','user','pass','url'];
    public function Cuentas(){
    	return  $this->belongsTo(Cuenta::class);
    }
}
