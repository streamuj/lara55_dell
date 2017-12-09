<?php

namespace App\Http\Controllers;

use App\Credit;
use App\InClubPerformer;
use App\Membership;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use Illuminate\Support\Facades\Cache;
//use GuzzleHttp\Client;

class DrController extends Controller
{
    //
    public function index(){

        $chat_id = app('App\Http\Controllers\MsChatController')->index();
        $allInClubGirls = InClubPerformer::all();
        $onStageGirls = $allInClubGirls->where('status', 3);
        $nextGirls = $allInClubGirls->where('status', 2);

        $videoUrl = $this->getVideoUrl();
        $dj = false;


        if(Auth::check()) {

            $membership = $this->userCheck();

            $user_id = Auth::id();
            $credits = $this->creditCheck();
            $content = User::findOrFail($user_id)->getPendingFriendships();
            $users = new User;
            $onlineUsers = $users->allOnline();

//            $url4k = "http://192.168.1.180:1935/orah4i/smil:360DR_premium.smil/playlist.m3u8";
            $url4k = "https://5964ed3e60741.streamlock.net/360DR_edge/smil:360DR_premium2.smil/playlist.m3u8";

            $role_id = User::findOrFail($user_id)->role_id;
            if($role_id ==1 || $role_id == 4){                  //DJ and Admin has DJ access
                $dj = true;
            }
            if($membership == true ){
                return view('dr.premium', compact('videoUrl','user_id', 'chat_id', 'onStageGirls','allInClubGirls', 'credits', 'dj', 'content','onlineUsers' ,'nextGirls','url4k'));  //paid subscriber
            }
            return view('mainstage.register', compact('videoUrl', 'user_id', 'chat_id', 'onStageGirls','allInClubGirls', 'credits', 'dj',  'content','onlineUsers'. 'nextGirls')); //registered user
        }else{
            return view('mainstage.guest', compact('videoUrl', 'onStagePerformers', 'chat_id', 'credits' ,'onlineUsers'));  //unregistered user
        }
    }

    function userCheck(){

        $user = Auth::user();
        $validMembership = false;
        $expire = User::findOrFail($user->id)->membership()->get(['end_date'])->sortByDesc('end_date')->first();  //getting membership end_date
        if($expire) {
            $carbon = Carbon::createFromFormat('Y-m-d', $expire->end_date);                         //if membership exists test date
            $validMembership = $carbon->isFuture(); // checking valid membership
        }

        $user_ip = request()->ip();    //checking access is from internal IP or not
        $internal_ip = false;
        $addresses = array(0 => '47.206.99.69', 1 => '97.76.55.218');
        if (in_array($user_ip, $addresses)) {
            $internal_ip = true;
        }

        if ($user->role_id < 5 || $validMembership || $internal_ip) {    //admin, paid member, clubs IP will have premium video
            return true;
        }
        return false;
    }

    function creditCheck(){
        $user = Auth::user();
        $credits = User::find($user->id)->credit()->get(['credits'])->first(); // getting users credit
        if(empty($credits)){
            return 0 ;
        }
        return $credits->credits;
    }

    function getVideoUrl(){

        $ch = curl_init("http://104.156.55.137:1935/redirect/?request=server&IP=A.B.C.D");     //getting wowza url from load balancer with CURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

//        $client = new Client();
//        $response = $client->request('GET', 'http://104.156.55.137:1935/redirect', ['request' =>'server&IP=A.B.C.D']);
////        $response = $client->request('GET', 'http://reqres.in/api/users', ['page' =>2]);
//        return $response;

        $server_ip = array("23.111.152.218:1935","104.156.55.137:1935", "23.111.137.194:1935" );   //converting IP address to streamlock URL
        $streamLock_url = array("59659a03dfb88.streamlock.net", "57daa77ec5645.streamlock.net", "5652cb24c16ee.streamlock.net");
        $serverUrl = str_replace($server_ip, $streamLock_url, $data);

        $premium_url      = "/dvredge/smil:2001MS_premium.smil/playlist.m3u8?DVR";    // later on DB
        $registered_url   = "/2001edge/2001MS_RTSP.stream_360p/playlist.m3u8";
        $guest_url        = "/2001edge/2001MS_RTSP.stream_240p/playlist.m3u8";


        if(Auth::check()){
            if($this->userCheck()){
                return "https://".$serverUrl.$premium_url;
            }
        }else{
            return "https://".$serverUrl.$registered_url;
        }
        return "https://".$serverUrl.$guest_url;
    }

    public function dj(){
        $chat_id = app('App\Http\Controllers\MsChatController')->index();


        $user_id = Auth::id();
        $role_id = User::findOrFail($user_id)->role_id;
        if($role_id == 1 || $role_id == 4){                      //If user role is admin or DJ give access.

            $allInHouseGirls = InClubPerformer::all();

            $inHouseGirls = $allInHouseGirls->where('status', 1);
            $nextGirls = $allInHouseGirls->where('status', 2);
            $onStageGirls = $allInHouseGirls->where('status', 3);

            $credits = $this->creditCheck();
            $dj = true;
            $content = User::findOrFail($user_id)->getPendingFriendships();
            $users = new User;
            $onlineUsers = $users->allOnline();

            return view('djConsole',compact('inHouseGirls', 'nextGirls', 'onStageGirls', 'credits', 'dj', 'content','onlineUsers', 'chat_id', 'user_id'));
        }else{
            return redirect('404');
        }

    }

}
