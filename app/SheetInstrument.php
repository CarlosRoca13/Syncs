<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SheetInstrument extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'sheetId',
        'instrument',
        'effects',
        'pdf',
    ];

    public function sheet() {
        return $this->belongsTo(Sheet::class);
    }
}
