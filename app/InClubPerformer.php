<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InClubPerformer extends Model
{
    //
    protected $fillable = ['user_id', 'status', 'nickname'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function performerProfile(){
        return $this->hasOne('App\PerformerProfile', 'user_id' ,'user_id');
    }

    public function allGirls(){
        return $this->all();
    }

    public function searchInClubGirls($name){
        $query = InClubPerformer::where('status', 1);
        $query->where('nickname', 'LIKE', '%' . $name . '%')->take(15);
        return  $query->get();

    }

}
