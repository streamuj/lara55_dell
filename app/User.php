<?php

namespace App;

use Hootlex\Friendships\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use Friendable;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function credit(){
        return $this->hasOne('App\Credit');
    }

    public function messages(){
        return $this->hasManyThrough(Message::class);
    }
    public function video(){
        return $this->hasMany('App\Video');
    }
    public function membership(){
        return $this->hasMany('App\Membership');
    }
    public function performerProfile(){
        return $this->hasOne('App\PerformerProfile');
    }

//    public function performerAddress(){
//        $this->hasOne('App\')
//    }

    public function searchAllGirls($name){
        $inClubGirls = InClubPerformer::select('user_id')->get();

        $query = User::where('role_id', 3);
        $query->where('name', 'LIKE', '%' . $name . '%')->whereNotIn('id', $inClubGirls)->take(15);
        return  $query->get();

    }


}
