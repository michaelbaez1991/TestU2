<?php

namespace App;

use App\Perfil;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'perfil_id', 'ciudad_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function perfil(){
        return $this->belongsTo(Perfil::class);
    }

    /*    
        public function authorizeRoles($roles){
            abort_unless($this->hasAnyRole($roles), 401);
            return true;
        }
        
        public function hasAnyRole($roles){
            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if ($this->hasRole($role)) {
                        return true;
                    }
                }
            } else {
                if ($this->hasRole($roles)) {
                     return true; 
                }   
            }
            return false;
        }
    */
    
    public function hasPerfil($perfil){
        if ($this->perfil()->where('namePerfil', $perfil)->first()) {
            return true;
        }
        return false;
    }
}
