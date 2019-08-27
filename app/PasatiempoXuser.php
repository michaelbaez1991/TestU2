<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasatiempoXuser extends Model{
	protected $table = 'pasatiempoXuser';

	protected $fillable = ['id', 'pasatiempo_id', 'users_id'];
}