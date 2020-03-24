<?php

namespace App\Http\Controllers\SheetInstrument;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SheetInstrument;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

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
        $pdf = $request->pdf->store('pdf', 'local');
        DB::table('sheet_instruments')->insert([
            'sheets_id' => $request['sheetId'],
            'instrument' => $request['instrument'],
            'effects' => $request['effects'],
            'pdf' => $pdf,
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sheetid, $instrument)
    {
        return DB::select('SELECT * FROM sheet_instruments WHERE sheets_id = :sheetid AND instrument = :instrument', [
            'sheetid' => $sheetid,
            'instrument' => $instrument,
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
    public function update(Request $request, $sheetid, $instrument)
    {
        return DB::update('UPDATE sheet_instruments SET sheets_id = :sheetid, instrument = :instrument, effects = :effects, pdf = :pdf WHERE sheets_id = :psheetid AND instrument = :pinstrument',[
            'sheetid' => $request['sheetId'],
            'instrument' => $request['instrument'],
            'effects' => $request['effects'],
            'pdf' => $request['pdf'],
            'psheetid' => $sheetid,
            'pinstrument' => $instrument,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sheetid, $instrument) // TO-DO: Hay que corregirlo
    {   
        return DB::delete('DELETE FROM sheet_instruments WHERE sheets_id = :sheet AND instrument = :instrument',[
            'sheet' => $sheetid,
            'instrument' => $instrument,
        ]);
    }
}
