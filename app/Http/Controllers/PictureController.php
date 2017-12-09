<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class PictureController extends Controller
{
    //
    public function upload(Request $request){

        $image = $request->file('image');
        $imageFileName = time() . '_' . $image->getClientOriginalName() .$image->getClientOriginalExtension();

        $disk = Storage::disk('s3');
        $disk->put($imageFileName, fopen($image, 'r+'));
        Picture::create(['path'=>$imageFileName,
                        'user_id'=>Auth::id(),
                        'title' => $request->title,

                        ]);
        return redirect()->back();

    }
    public function index(){

        return view('photoUpload');
    }

}
