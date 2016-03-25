<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $table = 'likable';

	public function likable()
	{
		return $this->morphTo();
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
