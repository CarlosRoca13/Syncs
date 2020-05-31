<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments = DB::table('comments')->where('sheets_id', '=', $id)->orderBy('dateTime', 'desc')->get();
        return $this->showAll($comments);
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

        return  DB::table('comments')->insert([
            'clients_id' => $request['clients_id'],
            'sheets_id' => $request['sheets_id'],
            'dateTime' => Carbon::now(),
            'response' => $request['response'],
            'description' => $request['description']
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $this->showOne($comment);
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
    public function destroy(Comment $comment)
    {
        $comment->delete();
        DB::delete('DELETE FROM comments WHERE id=?',[$comment['id']]);
        return $this->showOne($comment);
    }
}
