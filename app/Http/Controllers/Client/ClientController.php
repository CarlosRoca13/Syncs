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
        return DB::select('SELECT name, lastname, email, username, password, verified, birthday, avatar FROM clients WHERE username = :username',[
            'username' => $username
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function showimage($id)
    {
        $secuence = DB::select('SELECT avatar FROM clients WHERE id = :id', [
            'id' => $id
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
    public function update(Request $request, $id)
    {  
        $instance = DB::table('clients')->where('id', '=', $id)->get();
        $resultArray = json_decode(json_encode($instance), true);
        $updateData['name'] = ($request['name'] != null) ? $request['name'] : $resultArray[0]['name'];
        $updateData['lastname'] = ($request['lastname'] != null) ? $request['lastname'] : $resultArray[0]['lastname'];
        $updateData['email'] = ($request['email'] != null) ? $request['email'] : $resultArray[0]['email'];
        $updateData['username'] = ($request['username'] != null) ? $request['username'] : $resultArray[0]['username'];
        $updateData['password'] = ($request['password'] != null) ? $request['password'] : $resultArray[0]['password'];
        $updateData['verified'] = ($request['verified'] != null) ? $request['verified'] : $resultArray[0]['verified'];
        $updateData['avatar'] = ($request['avatar'] != null) ? $request->avatar->store('images', 'local') : $resultArray[0]['avatar'];
        $updateData['birthday'] = ($request['birthday'] != null) ? $request['birthday'] : $resultArray[0]['birthday'];

        return DB::table('clients')->where('id','=', $id)->update($updateData);
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
