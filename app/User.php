<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function getRouteKeyName(){
        return 'id';
    }
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function AutorizarRoles($roles){
        if($this->hasAnyRole($roles)){
            return true;
        }
        abort(401,'Su rol no esta autorizado');
    }

    public function hasAnyRole($roles){
        if(is_array($roles)){
          foreach ($roles as $key) {
            if($this->hasRole($key)){
                return true;
            }
          }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
       return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
            return true;
        }else{
            return false;
        }
    }
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
