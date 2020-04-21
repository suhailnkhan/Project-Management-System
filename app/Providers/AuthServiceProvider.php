<?php

namespace App\Providers;
use App\Policies\Assign;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',

        //'App\User' => assign::class
        User::class => Assign::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('assigntask', 'App\Policies\Assign@Assign_only');


        Gate::define('makeunassignedtask', function ($user) {
            return $user->admin;
        });


            //function ($user) {
            //return $user->Role == 'Assign';
      //return $user->Assign;


}

}
