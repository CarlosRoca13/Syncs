<?php

namespace App\Http\Controllers\SheetInstrument;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SheetInstrument;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SheetInstrumentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secuence = DB::select('SELECT * FROM sheet_instruments');
        foreach ($secuence as $si) {
            $contents = Storage::response($si->pdf);
            $si->pdf = $contents;
        }
        return $secuence;
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
            'sheets_id' => $request['sheets_id'],
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
        return DB::select('SELECT sheets_id, instrument, effects FROM sheet_instruments WHERE sheets_id = :sheetid AND instrument = :instrument', [
            'sheetid' => $sheetid,
            'instrument' => $instrument,
        ]);
    }

    public function showbysheet($sheetid)
    {
        return DB::select('SELECT instrument FROM sheet_instruments WHERE sheets_id = :sheetid', [
            'sheetid' => $sheetid
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showpdf($sheetid, $instrument)
    {
        $secuence = DB::select('SELECT pdf FROM sheet_instruments WHERE sheets_id = :sheetid AND instrument = :instrument', [
            'sheetid' => $sheetid,
            'instrument' => $instrument,
        ]);
        return Storage::response($secuence[0]->pdf);
    }

    public function downloadpdf($sheetid, $instrument){
        $secuence = DB::select('SELECT pdf FROM sheet_instruments WHERE sheets_id = :sheetid AND instrument = :instrument', [
            'sheetid' => $sheetid,
            'instrument' => $instrument,
        ]);
        $path = base_path() . '\storage\app\assets\\' . $secuence[0]->pdf;
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        $name = explode('/',  $secuence[0]->pdf);
        return response()->download($path, $name[1], $headers);
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
