<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class SearchController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request['name'];
        return DB::select('SELECT COALESCE(s.name, NULL) as sheet, COALESCE(s.id, NULL) as sheetid, COALESCE(c.name, NULL) as client, COALESCE(c.id, NULL) as clientId, COALESCE(p.name, NULL) as playlist, COALESCE(p.id, NULL) as playlistId FROM sheets as s FULL JOIN clients as c USING(name) FULL JOIN playlists as p USING(name)WHERE UPPER(name) like UPPER(:name)',['name'=> '%' . $name . '%']);
        
    }

    public function getsongartist($id)
    {
        return DB::select('SELECT c.name as client FROM clients as c  JOIN sheets as s ON(s.clients_id = c.id) WHERE s.id = :sheetid',['sheetid' => $id]);
    }

    public function getplaylistartist($id)
    {
        return DB::select('SELECT c.name as client FROM clients as c JOIN playlists as p ON(p.clients_id = c.id) WHERE p.id = :playlistid',['playlistid' => $id]);
    }
}
