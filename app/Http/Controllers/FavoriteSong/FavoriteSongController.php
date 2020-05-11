<?php

namespace App\Http\Controllers\FavoriteSong;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteSongController extends Controller
{
    public function add($sheetid, $clientid)
    {
        return DB::insert('INSERT INTO favorite_songs VALUES(:clientid, :sheetid)', [
            'clientid' => $clientid,
            'sheetid' => $sheetid,
        ]);
    }

    public function remove($sheetid, $clientid)
    {
        return DB::delete('DELETE FROM favorite_songs WHERE clients_id = :clientid AND sheets_id = :sheetid', [
            'clientid' => $clientid,
            'sheetid' => $sheetid,
        ]);
    }

    public function list($clientid)
    {
        return DB::select('SELECT s.id, s.name, (SELECT username FROM clients WHERE id = s.clients_id) as artist, s.image FROM sheets as s WHERE s.id IN (SELECT sheets_id FROM favorite_songs WHERE clients_id = :clientid)',[
            'clientid' => $clientid
        ]);
    }

    public function isfavorite($sheetid, $clientid) {
        $users = DB::table('favorite_songs')->where('sheets_id', $sheetid)->pluck('clients_id')->toArray();
        if(in_array($clientid, $users)){
            return response()->json(true);
        }
        return response()->json(false);
    }
}
