<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoPurchaseController extends Controller
{
    //

    public function buyVideo(Request $request){
        $video_id= $request->all();
        $videos = Video::findOrFail($video_id);
        $video = $videos[0];
        $credits = app('App\Http\Controllers\MainStageController')->creditCheck();

        if($credits > $video->is_paid){
            // add video purchase record
            $payload = new VideoPurchase;
            $payload->video_id = $video->id;
            $payload->performer_id = $video->user_id;
            $payload->purchaser_id = Auth::id();
            $payload->purchased_credits = $video->is_paid;
            $payload->performer_credits = $video->is_paid * .4 ;
            $payload->club_credits = $video->is_paid * .3;
            $payload->ServiceProvider_credits = $video->is_paid * .3;

            $payload->unique_id = str_random();

            $payload->save();

            return "success";

        }else{
            // insufficient fund action
        }

    }

    public function checkRecord($id){
        $user_id = Auth::id();
        return VideoPurchase::where('video_id', $id)->where('purchaser_id', $user_id)->get();

    }
}
