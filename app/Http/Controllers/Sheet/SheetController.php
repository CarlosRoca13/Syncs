<?php

namespace App\Http\Controllers\Sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sheet;
use App\Http\Controllers\ApiController;

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
        return $this->showOne($sheet);
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

        return $this->showOne($sheet);
    }
}
