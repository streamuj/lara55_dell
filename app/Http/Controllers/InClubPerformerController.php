<?php

namespace App\Http\Controllers;

use App\InClubPerformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InClubPerformerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $performers = InClubPerformer::all();
        return $performers;


    }

    public function search($name){

        $girls = new InClubPerformer();
        $inClubGirls = $girls->searchInClubGirls($name);

        $payload = "";
            foreach($inClubGirls as $girl){
               $payload .='<div class="girlContainer" id="'.$girl->user->id.'">'
                            .'<img src="/storage/'.$girl->user->avatar.'" alt="User Avatar" class="img-circle" height="100"/>'
                                .'<div class="girlName caption post-content">'
                                    .'<h3>'.$girl->user->name.'</h3>'
                                .'</div>'
                            .'</div>';

            }


        return response()->json(['payload' => $payload]);


//        return $girls->allGirls($name);

//        return $name;
    }
    public function allGirlsSearch($name){

        $user = new User();
        $inClubGirls = $user->searchAllGirls($name);

        $payload = "";
        foreach($inClubGirls as $girl){
            $payload .='<div class="girlContainer" id="'.$girl->id.'">'
                .'<img src="/storage/'.$girl->avatar.'" alt="User Avatar" class="img-circle" height="100"/>'
                .'<div class="girlName caption post-content">'
                .'<h3>'.$girl->name.'</h3>'
                .'</div>'
                .'</div>';
        }
        return response()->json(['payload' => $payload]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nickname = User::findOrFail($request->user_id)->name;
        return InClubPerformer::updateOrCreate(['user_id'=>$request->user_id],['status'=>$request->status,'nickname'=>$nickname]);
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
        $girlList = InClubPerformer::where('status', $id);
        return $girlList;

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
//        $performer = InClubPerformer::Where('user_id', $id)->get();
        return InClubPerformer::where('user_id', $id)->delete();

//        return $performer->delete();


    }

    public function inHouse(){
        $girls = InClubPerformer::paginate(15);

        if(Auth::check()){
            $credits = app('App\Http\Controllers\MainStageController')->creditCheck();
            $user_id = Auth::id();
            $content = User::findOrFail($user_id)->getPendingFriendships();
            $dj = false;

            $role_id = User::findOrFail($user_id)->role_id;
            if($role_id ==1 || $role_id == 4) {                  //DJ and Admin has DJ access
                $dj = true;
            }
            return view('inHouseGirls', compact('girls', 'credits', 'content', 'dj'));

        }else{
            return view('inHouseGirls', compact('girls'));

        }


    }

    public function allGirls(){
        $girls = User::where('role_id', 3)->paginate(15);
        if(Auth::check()){

        $credits = app('App\Http\Controllers\MainStageController')->creditCheck();
        $user_id = Auth::id();
        $content = User::findOrFail($user_id)->getPendingFriendships();
        $dj = false;

        $role_id = User::findOrFail($user_id)->role_id;
        if($role_id ==1 || $role_id == 4) {                  //DJ and Admin has DJ access
            $dj = true;
        }
        return view('allGirls', compact('girls', 'credits', 'content', 'dj'));

    }else{
            return view('allGirls', compact('girls'));

        }
    }


}
