<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'clients_id',
        'description',
        'key',
        'main_genre',
        'likes',
        'dislikes',
        'views',
        'downloads',
        'image',
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'sheetId');
    }

    public function sheetInstruments() {
        return $this->hasMany(SheetInstrument::class, 'sheetId');
    }

    public function playlistItems() {
        return $this->hasMany(PlaylistItem::class, 'sheetId');
    }
}
