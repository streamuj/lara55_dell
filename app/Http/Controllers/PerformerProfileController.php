<?php

namespace App\Http\Controllers;

use App\PerformerCredit;
use App\PerformerProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class PerformerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('performer.createProfile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create user account
        $userInfo['name']       = $request->nickname;
        $userInfo['password']   = bcrypt($request->password);
        $userInfo['email']      = $request->email;
        $userInfo['role_id']    = 3;     // Performer

//          $this->uploadAvatar($file);

    if($request->file('avatar')) {
        $user = User::create($userInfo);  //save user table once

        $fullFilename = null;
        $resizeWidth = 512;
        $resizeHeight = null;
        $slug = 'users';
        $file = $request->file('avatar');

        $path = $slug . '/' . date('F') . date('Y') . '/';

        $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension());
        $filename_counter = 1;

        // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
        while (Storage::disk(config('voyager.storage.disk'))->exists($path . $filename . '.' . $file->getClientOriginalExtension())) {
            $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension()) . (string)($filename_counter++);
        }

        $fullPath = $path . $filename . '.' . $file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 75);
            if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string)$image, 'public')) {
                $avatar = $fullPath;
                User::whereId($user->id)->update(['avatar' => $avatar]);

            }

        }
    }


        PerformerCredit::create(['user_id' => $user->id, 'credits' => 0]); // create performer credits

        $profile['user_id']     = $user->id;
        $profile['nickname']    = $request->nickname;
        $profile['description'] = $request->description;
        $profile['turnOn']      = $request->turnOn;
        $profile['turnOff']     = $request->turnOff;
        $profile['ethnicity']   = $request->ethnicity;
        $profile['height']      = $request->height;
        $profile['hair_color']  = $request->hair_color;
        $profile['eye_color']   = $request->eye_color;
        $profile['build']       = $request->build;
        $profile['cup_size']    = $request->cup_size;
        $profile['birthday']    = $request->birthday;

        PerformerProfile::create($profile);


        Auth::loginUsingId($user->id);

        return redirect ('/performer');



        //crete performer profile
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar($file)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = 'users';

        $path = $slug.'/'.date('F').date('Y').'/';

        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $filename_counter = 1;

        // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension()).(string) ($filename_counter++);
        }

        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                $status = __('voyager.media.success_uploading');
                $fullFilename = $fullPath;
            }
        }
        // echo out script that TinyMCE can handle and update the image in the editor
    }

    public function show($nickname)
    {
        //
        $profiles = PerformerProfile::where('nickname',$nickname)->get();
        $profile = $profiles[0];
        $profile->zodiac = $this->beliefmedia_zodiac($profile->birthday);
        $born = Carbon::createFromFormat('Y-m-d', $profile->birthday);
        $cake = Carbon::now();
        $profile->BDGirl = $born->isBirthday($cake);
        $pictures = "";

        if (Auth::check()) {

            $credits = app('App\Http\Controllers\MainStageController')->creditCheck();
            $user_id = Auth::id();
            $content = User::findOrFail($user_id)->getPendingFriendships();
            $dj = false;

            $role_id = User::findOrFail($user_id)->role_id;
            if ($role_id == 1 || $role_id == 4) {                  //DJ and Admin has DJ access
                $dj = true;
            }
            return view('component.profilePage', compact('profile', 'credits', 'content', 'dj', 'pictures'));
        } else {
            return view('component.profilePage', compact('profile', 'pictures'));
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
    function beliefmedia_zodiac($birthdate) {

        $zodiac = '';
        list ($year, $month, $day) = explode ('-', $birthdate);

        if ( ( $month == 3 && $day > 20 ) || ( $month == 4 && $day < 20 ) ) { $zodiac = "Aries"; }
        elseif ( ( $month == 4 && $day > 19 ) || ( $month == 5 && $day < 21 ) ) { $zodiac = "Taurus"; }
        elseif ( ( $month == 5 && $day > 20 ) || ( $month == 6 && $day < 21 ) ) { $zodiac = "Gemini"; }
        elseif ( ( $month == 6 && $day > 20 ) || ( $month == 7 && $day < 23 ) ) { $zodiac = "Cancer"; }
        elseif ( ( $month == 7 && $day > 22 ) || ( $month == 8 && $day < 23 ) ) { $zodiac = "Leo"; }
        elseif ( ( $month == 8 && $day > 22 ) || ( $month == 9 && $day < 23 ) ) { $zodiac = "Virgo"; }
        elseif ( ( $month == 9 && $day > 22 ) || ( $month == 10 && $day < 23 ) ) { $zodiac = "Libra"; }
        elseif ( ( $month == 10 && $day > 22 ) || ( $month == 11 && $day < 22 ) ) { $zodiac = "Scorpio"; }
        elseif ( ( $month == 11 && $day > 21 ) || ( $month == 12 && $day < 22 ) ) { $zodiac = "Sagittarius"; }
        elseif ( ( $month == 12 && $day > 21 ) || ( $month == 1 && $day < 20 ) ) { $zodiac = "Capricorn"; }
        elseif ( ( $month == 1 && $day > 19 ) || ( $month == 2 && $day < 19 ) ) { $zodiac = "Aquarius"; }
        elseif ( ( $month == 2 && $day > 18 ) || ( $month == 3 && $day < 21 ) ) { $zodiac = "Pisces"; }

        return $zodiac;
    }
}
