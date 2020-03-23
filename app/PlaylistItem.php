<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'playlists_id',
        'sheets_id',
    ];

    protected $dates = ['deleted_at'];
    
    public function playlist() {
        return $this->belongsTo(Playlist::class);
    }

    public function sheet() {
        return $this->belongsTo(Sheet::class);
    }
}
