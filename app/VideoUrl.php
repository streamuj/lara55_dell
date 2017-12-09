<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoUrl extends Model
{
    //
    protected $fillable = ['name', 'url'];

    public function getUrl(){

    }
}


