<?php

namespace App\Http\Controllers\Sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sheet;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class SheetController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sheets = Sheet::all();
        return $this->showAll($sheets);
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
        $sheet = Sheet::create($request->all());
        return $this->showOne($sheet, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        return DB::select('SELECT s.name, c.username, s.description, s.key, s.main_genre, s.likes, s.dislikes, s.views, s.downloads, s.image FROM sheets as s JOIN clients as c ON (c.id = s.clients_id) WHERE s.id = :sheetId',[$sheet['id']]);
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
    public function update(Request $request, Sheet $sheet)
    {
        $sheet->fill($request->only([
            'name',
            'clientId',
            'description',
            'key',
            'mainGenre',
            'likes',
            'dislikes',
            'views',
            'downolads',
            'image',
        ]));

        if($sheet->isClean()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para actuaizar', 422);
        }
        $sheet->save();

        return $this->showOne($sheet);
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
}
