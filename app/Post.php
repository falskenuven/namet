<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['user_id', 'group_id', 'title', 'article', 'image'];

	protected $appends = ['createdDate'];

    public function user()
	{
	   return $this->belongsTo(User::class);
	}

	public function group()
	{
	   return $this->belongsTo(Group::class);
	}

	public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
