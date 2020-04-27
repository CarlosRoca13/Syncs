<?php

namespace App\Http\Controllers\LikedSong;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikedSongController extends Controller
{
    public function uplike($sheetid, $clientid)
    {
        DB::delete('DELETE FROM disliked_songs WHERE sheets_id = :sheetid AND clients_id = :clientid', [
            'sheetid' => $sheetid,
            'clientid' => $clientid
        ]);
        return DB::insert('INSERT INTO liked_songs VALUES(:clientid, :sheetid)',[
            'clientid' => $clientid,
            'sheetid' => $sheetid
        ]);
    }

    public function downlike($sheetid, $clientid)
    {
        return DB::delete('DELETE FROM liked_songs WHERE clients_id = :clientid AND sheets_id = :sheetid',[
            'clientid' => $clientid,
            'sheetid' => $sheetid
        ]);
    }

    public function getuser($sheetid, $clientid)
    {
        $users = DB::table('liked_songs')->where('sheets_id', $sheetid)->pluck('clients_id')->toArray();
        if(in_array($clientid, $users)){
            return response()->json(true);
        }
        return response()->json(false);
    }
}
