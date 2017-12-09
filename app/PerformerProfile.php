<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformerProfile extends Model
{
    //
    protected $fillable = [
        'user_id','description', 'turnOn', 'turnOff', 'ethnicity', 'height', 'nickname',
        'hair_color', 'eye_color', 'build', 'cup_size', 'birthday', 'landing_image_path'
        ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function inClubPerformer(){
        return $this->belongsTo('App\InClubPerformer');
    }


}
