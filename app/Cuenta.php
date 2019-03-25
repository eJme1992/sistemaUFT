<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
	//Que campos puedo actualizar
    protected $fillable = ['nombre','logo','descripcion','tipo','correo','telefono','tipo',
'industria','calle','ciudad','provincia','pais','codigo_postal','referido','tema','estado','baja','crm' ];


    // Me permite usar una clave primaria diferente al id para las busquedas
    public function contactos(){
    	return  $this->hasMany(Contacto::class);
    }
     public function hosts(){
        return  $this->hasMany(Host::class);
    }
     public function mails(){
        return  $this->hasMany(Mail::class);
    }
     public function dbs(){
        return  $this->hasMany(Db::class);
    }
     public function sociales(){
        return  $this->hasMany(Social::class);
    }
      public function crms(){
        return  $this->hasMany(Crm::class);
    }

     public function getRouteKeyName(){
        return 'slug';
    }

    public function limpiarCaracteresEspeciales($string ){
    $string = htmlentities($string);
    $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
    return $string;
    }

}
