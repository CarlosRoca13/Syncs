<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return $this->showAll($clients);
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
        $avatar = null;
        if($request['avatar'] != null) {
            $avatar = $request->avatar->store('images', 'local');
        }

        DB::table('clients')->insert([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => $request['password'],
            'verified' => $request['verified'],
            'avatar' => $avatar,
            'birthday' => $request['birthday'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        return DB::select('SELECT name, lastname, email, username, password, verified, birthday FROM clients WHERE username = :username',[
            'username' => $username
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function showimage($username)
    {
        $secuence = DB::select('SELECT avatar FROM clients WHERE username = :username', [
            'username' => $username
        ]);
        return Storage::response($secuence[0]->avatar);
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
    public function update(Request $request, Client $client)
    {
        $client->fill($request->only([
            'name',
            'lastname',
            'email',
            'username',
            'password',
            'verified',
            'avatar',
            'birthday',
        ]));

        if($client->isClean()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para actuaizar', 422);
        }
        $client->save();

        return $this->showOne($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        DB::delete('DELETE FROM CLIENTS WHERE id=?',[$client['id']]);
        return $this->showOne($client);
    }
}
