<?php

namespace App\Http\Controllers\PlaylistItem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PlaylistItem;
use App\Http\Controllers\ApiController;

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
    public function show(PlaylistItem $playlistitem)
    {
        return $this->showOne($playlistitem);
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
    public function destroy(PlaylistItem $playlistitem)
    {
        $playlistitem->delete();

        return $this->showOne($playlistitem);
    }
}
