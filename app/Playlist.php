<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'clientId',
        'name',
        'image',
        'description',
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function playlistItems() {
        return $this->hasMany(PlaylistItem::class, 'playlistId');
    }
}
