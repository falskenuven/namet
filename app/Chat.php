<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Chat extends Model
{
	protected $fillable = ['user_main', 'user'];

	public function user_main()
	{
	   return $this->belongsTo(User::class);
	}
}
