<?php

namespace App\Http\Controllers\Sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sheet;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SheetController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::select('SELECT s.id, s.name, c.username, s.description, s.key, s.main_genre, (SELECT COUNT(*) FROM liked_songs WHERE sheets_id = s.id) as likes, (SELECT COUNT(*) FROM disliked_songs WHERE sheets_id = s.id) as dislikes, s.views, s.downloads, s.image FROM sheets as s JOIN clients as c ON(s.clients_id = c.id)');
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
        $image = null;
        if($request['image'] != null) {
            $image = $request->image->store('images', 'local');
        }
        DB::table('sheets')->insert([
            'name' => $request['name'],
            'clients_id' => $request['clients_id'],
            'description' => $request['description'],
            'key' => $request['key'],
            'main_genre' => $request['main_genre'],
            'views' => $request['views'],
            'downloads' => $request['downloads'],
            'image' => $image,
        ]);
        return response()->json(DB::getPdo()->lastInsertId());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::select('SELECT s.name, c.username, s.description, s.key, s.main_genre, (SELECT COUNT(*) FROM liked_songs WHERE sheets_id = :id) as likes, (SELECT COUNT(*) FROM disliked_songs WHERE sheets_id = :id) as dislikes, s.views, s.downloads, s.image FROM sheets as s JOIN clients as c ON(s.clients_id = c.id) WHERE s.id = :id',[
            'id' => $id
        ]);
    }

    public function showbyclientid($clientid)
    {
        return DB::select('SELECT s.id, s.name, c.username, s.description, s.key, s.main_genre, (SELECT COUNT(*) FROM liked_songs WHERE sheets_id = s.id) as likes, (SELECT COUNT(*) FROM disliked_songs WHERE sheets_id = s.id) as dislikes, s.views, s.downloads, s.image FROM sheets as s JOIN clients as c ON(s.clients_id = c.id) WHERE s.clients_id = :clientid',[
            'clientid' => $clientid
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showimage($id)
    {
        $secuence = DB::select('SELECT image FROM sheets WHERE id = :id', [
            'id' => $id
        ]);
        return Storage::response($secuence[0]->image);
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
        $instance = DB::table('sheets')->where('id', '=', $id)->get();
        $resultArray = json_decode(json_encode($instance), true);
        $updateData['name'] = ($request['name'] != null) ? $request['name'] : $resultArray[0]['name'];
        $updateData['description'] = ($request['description'] != null) ? $request['description'] : $resultArray[0]['description'];
        $updateData['key'] = ($request['key'] != null) ? $request['key'] : $resultArray[0]['key'];
        $updateData['main_genre'] = ($request['main_genre'] != null) ? $request['main_genre'] : $resultArray[0]['main_genre'];
        $updateData['image'] = ($request['image'] != null) ? $request->image->store('images', 'local') : $resultArray[0]['image'];

        DB::table('sheets')->where('id','=', $id)->update($updateData);
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        $sheet->delete();
        DB::delete('DELETE FROM sheets WHERE id=?',[$sheet['id']]);
        return $this->showOne($sheet);
    }

    public function upview($id)
    {
        return DB::update('UPDATE sheets SET views = views + 1 WHERE id = :id',['id' => $id]);        
    }

    public function updownload($id)
    {
        return DB::update('UPDATE sheets SET downloads = downloads + 1 WHERE id = :id',['id' => $id]);
    }

    public function getartists()
    {
        return DB::select('SELECT DISTINCT s.clients_id, c.username, c.avatar, (SELECT count(*) FROM follows WHERE user_id = s.clients_id) as followers FROM sheets as s JOIN clients as c ON (s.clients_id = c.id)');
    }
}
