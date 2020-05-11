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
    public function searchartist($name)
    {
        return DB::select('SELECT COALESCE(c.username, NULL) as client, COALESCE(c.id, NULL) as clientId, COALESCE(c.avatar, NULL) as avatar FROM clients as c WHERE UPPER(username) like UPPER(:name)',['name'=> '%' . $name . '%']);    
    }
        
    public function searchsong($name)
    {
        return DB::select('SELECT COALESCE(s.name, NULL) as sheet, COALESCE(s.id, NULL) as sheetid, (SELECT username FROM clients WHERE id = s.clients_id) as client FROM sheets as s WHERE UPPER(name) like UPPER(:name)',['name'=> '%' . $name . '%']);    
    }

    public function getsongartist($id)
    {
        return DB::select('SELECT c.username as client FROM clients as c  JOIN sheets as s ON(s.clients_id = c.id) WHERE s.id = :sheetid',['sheetid' => $id]);
    }
}
