<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteSong extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'clients_id',
        'sheets_id'
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function sheet() {
        return $this->belongsTo(Sheet::class);
    }
}
