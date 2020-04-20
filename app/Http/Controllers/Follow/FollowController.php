<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends ApiController
{

    public function index($user_id)
    {
        $followers = DB::table('follows')->where('user_id', $user_id)->pluck('follower_id')->toArray();
        return response()->json($followers);
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
