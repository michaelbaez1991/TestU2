<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model{

	protected $table = 'perfil';
	
	protected $fillable = ['id', 'namePerfil', 'descriptionPerfil'];

	public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
