<?php

namespace App\Http\Controllers;

use App\MsChat;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MsChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currentChatId = MsChat::count();
        return $currentChatId;
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
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        $currentChatId = MsChat::count();

        if($id < $currentChatId){
            $newId = $id + 1;
            $newMessage = MsChat::findOrFail($newId);

//            $user = User::findOrFail($newMessage->user_id);
            $response['message'] = $newMessage->message;
            $response['username'] = $newMessage->user->name;
            $response['avatar'] = $newMessage->user->avatar;

            $result['newMessage'] = true;
            $result['payload'] = $response;
        }else {
            $result['newMessage'] = false;
        }
        return $result;
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
    public function destroy($id)
    {
        //
    }
    public function post(Request $request)
    {
        //
        $data = ['message' => $request->message,
            'user_id' =>$request->user_id,
        ];

        return MsChat::create($data);
    }
}
