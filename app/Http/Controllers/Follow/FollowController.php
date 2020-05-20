<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\ApiController;
use App\Mail\NotifyFollowers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FollowController extends ApiController
{

    public function index($user_id)
    {
        $followers = DB::table('follows')->where('user_id', $user_id)->pluck('follower_id')->toArray();
        return response()->json($followers);
    }


    public function r_follows($user_id)
    {
        $follows = DB::table('follows')->where('follower_id', $user_id)->pluck('user_id')->toArray();
        return response()->json($follows);
    }

    public function email($user_id){
        $followers = DB::table('follows')->where('user_id', $user_id)->pluck('follower_id')->toArray();
        $emails = DB::table('clients')->whereIn('id', $followers)->pluck('email');
        $artista = DB::table('clients')->where('id', $user_id) ->pluck('username');
        foreach($emails as $email){
            Mail::to($email)->send(new NotifyFollowers($artista[0]));
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('follows')->insert([
            'user_id' => $request['user_id'],
            'follower_id' => $request['follower_id']
        ]);
    }



    public function destroy($user_id, $follower_id)
    {
        DB::table('follows')->where([['user_id', $user_id],['follower_id', $follower_id]])->delete();
    }
}
