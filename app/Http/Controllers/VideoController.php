<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\VideoPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::where('is_public', 1)->paginate(15);

        if (Auth::check()) {

            $credits = app('App\Http\Controllers\MainStageController')->creditCheck();
            $user_id = Auth::id();
            $content = User::findOrFail($user_id)->getPendingFriendships();
            $dj = false;

            $role_id = User::findOrFail($user_id)->role_id;
            if ($role_id == 1 || $role_id == 4) {                  //DJ and Admin has DJ access
                $dj = true;
            }
            return view('allVideos', compact('videos', 'credits', 'content', 'dj'));
        } else {
            return view('allVideos', compact('videos'));
        }
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
        $video = Video::findOrFail($id);
        if ($video->is_public) {
            if ($video->is_paid > 0) {   //Check if customer purchased video
                $user_id = Auth::id();
                $records = VideoPurchase::all();
                $purchased = $records->search(['purchaser_id' => $user_id , 'video_id' => $id]);

                if ($purchased) {
                    $this->addPlayCount($id);
                    return $video;
                } else {
                    $video->haveNotPaid = true;
                    $video->path = "";
                    return $video;
                }
            }
            $this->addPlayCount($id);
            return $video;
        } else{
            return false;
        }


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
        $input = $request->all();
        Auth::user()->video()->whereId($id)->first()->update($input);
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

    public function addPlayCount($id){

        $videos = Video::where('id', $id)->get();
        $video = $videos[0];
        $play_count = $video->play_count + 1;
        return DB::table('videos')->where('id', $id)->update(['play_count' => $play_count]);

    }

    public function addPurchaseCount($id){

        $videos = Video::where('id', $id)->get();
        $video = $videos[0];
        $purchase_count = $video->purchase_count + 1;
        return DB::table('videos')->where('id', $id)->update(['purchase_count' => $purchase_count]);

    }
}
