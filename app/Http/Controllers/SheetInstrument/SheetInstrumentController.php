<?php

namespace App\Http\Controllers\SheetInstrument;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SheetInstrument;
use App\Http\Controllers\ApiController;

class SheetInstrumentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sheetinstruments = SheetInstrument::all();
        return $this->showAll($sheetinstruments);
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
        $sheetinstrument = Sheet::create($request->all());
        return $this->showOne($sheetinstrument, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SheetInstrument $sheetinstrument)
    {
        return $this->showOne($sheetinstrument);
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
    public function update(Request $request, SheetInstrument $sheetinstrument)
    {
        $sheetinstrument->fill($request->only([
            'sheetId',
            'instrument',
            'effects',
            'pdf',
        ]));

        if($sheetinstrument->isClean()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para actuaizar', 422);
        }
        $sheetinstrument->save();

        return $this->showOne($sheetinstrument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SheetInstrument $sheetinstrument)
    {
        $sheetinstrument->delete();

        return $this->showOne($sheetinstrument);
    }
}
