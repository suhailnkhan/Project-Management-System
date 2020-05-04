<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Url
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function Assign_only($user){

        return $user->Role == 'Assign';
//
//            if($user->Role == 'Assign') {
//
//                return true;
//
//            }else{
//
//                return false;
//            }

    }
}
