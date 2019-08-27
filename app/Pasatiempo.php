<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasatiempo extends Model{
	protected $table = 'pasatiempo';

	protected $fillable = ['id', 'pasatiempo'];
}
