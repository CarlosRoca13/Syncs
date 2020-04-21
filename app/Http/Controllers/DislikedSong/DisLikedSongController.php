<?php

namespace App\Http\Controllers\DislikedSong;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisLikedSongController extends Controller
{
    public function updislike($sheetid, $clientid)
    {
        return DB::insert('INSERT INTO disliked_songs VALUES(:clientid, :sheetid)',[
            'clientid' => $clientid,
            'sheetid' => $sheetid
        ]);
    }

    public function downdislike($sheetid, $clientid)
    {
        return DB::delete('DELETE FROM disliked_songs WHERE clients_id = :clientid AND sheets_id = :sheetid',[
            'clientid' => $clientid,
            'sheetid' => $sheetid
        ]);
    }

    public function getuser($sheetid, $clientid)
    {
        $users = DB::table('disliked_songs')->where('sheets_id', $sheetid)->pluck('clients_id')->toArray();
        if(in_array($clientid, $users)){
            return response()->json(true);
        }
        return response()->json(false);
    }
}
