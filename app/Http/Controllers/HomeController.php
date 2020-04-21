<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected function authenticated($request , $user){

        if($user->Role=='admin' || $user->Role=='Assign'){
            return redirect('/admin/index');

        }else{

            return redirect('/user/index');
        }
    }

    public function index()
    {
        return view('home');
    }
}
