<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'username',
        'password',
        'verified',
        'avatar',
        'birthday',
    ];
    
    public function sheets() {
        return $this->hasMany(Sheet::class, 'clientId');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'clientId');
    }

    public function playlists() {
        return $this->hasMany(Playlist::class, 'clientId');
    }
}
