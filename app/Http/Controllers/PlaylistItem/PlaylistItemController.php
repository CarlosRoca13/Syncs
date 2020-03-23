<?php

namespace App\Http\Controllers\PlaylistItem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PlaylistItem;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class PlaylistItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlistitems = PlaylistItem::all();
        return $this->showAll($playlistitems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $playlistitem = PlaylistItem::create($request->all());
        return $this->showOne($playlistitem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($playlist, $sheetId)
    {
        return DB::select('SELECT * FROM playlist_items WHERE playlists_id = :playlist AND sheets_id = :sheetId', [
            'playlist' => $playlist,
            'sheetId' => $sheetId,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($playlist, $sheetId)
    {
        return DB::delete('DELETE FROM playlist_items WHERE sheets_id = :sheet AND playlists_id = :playlist',[
            'sheet' => $sheetId,
            'playlist' => $playlist,
        ]); 
    }
}
