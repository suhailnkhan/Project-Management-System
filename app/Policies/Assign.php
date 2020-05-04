<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Assign
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


    public function AccessAdmin($user){

        return $user->Role == 'admin'  ;

    }



    public function Delete_user($user){

        return $user->Role == 'admin';
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
