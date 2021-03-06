<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'clients_id',
        'sheets_id',
        'date_time',
        'description',
        'response',
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function sheet() {
        return $this->belongsTo(Sheet::class);
    }

    public function comment() {
        return $this->belongsTo(Comment::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'response');
    }
}
