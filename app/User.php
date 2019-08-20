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

    protected $appends = ['profileLink'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
       return $this->hasMany(Post::class);
    }

    public function chats_adm()
    {
       return $this->hasMany(Chat::class, 'user_main');
    }

    public function groups()
    {
       return $this->hasMany(Group::class);
    }

    public function getRouteKeyName()
    {
       return 'name';
    }

    public function getProfileLinkAttribute()
    {
        return route('user.show', $this);
    }

    public function following()
    {
       return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // public function isNot($user)
    // {
    //     return $this->id !== $user->id;
    // }

    public function isNot($id)
    {
        return $this->id !== $id;
    }

    // public function isFollowing($user)
    // {
    //     return (bool) $this->following->where('id', $user->id)->count();
    // }

    public function isFollowing($id)
    {
        return (bool) $this->following->where('id', $id)->count();
    }

    public function canFollow($user)
    {
        if(!$this->isNot($user)) {
            return false;
        }
        return !$this->isFollowing($user);
    }

    // public function canUnFollow($user)
    // {
    //     return $this->isFollowing($user);
    // }

    public function canUnFollow($id)
    {
        return $this->isFollowing($id);
    }


}
