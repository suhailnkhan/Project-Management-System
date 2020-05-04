<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{



    use Notifiable,LogsActivity;
    //logging activity

    protected static $logAttributes = ['name', 'email'];
    public function getDescriptionForEvent(string $eventName): string
    {

        //$user = Auth::user()->name;
        return " {$eventName} user";

    }
    protected static $logName = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(\App\Post::class);
    }



    public function  isonline(){


        return Cache::has('user-is-online'. $this->id);
    }



    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // A user can also receive a message
    public function received()
    {
        return $this->hasMany(Message::class, 'sent_to_id');
    }


//    public function Role($Role) {
//        $Role = (array)$Role;
//        return in_array($this->Role, $Role);
//    }
//    public function uploads()
//    {
//        return $this->hasMany(\App\Upload::class);
//    }

//    public function uploads(){
//
//        return $this->belongsTo(\App\Uploads::class);
//
//    }

}
