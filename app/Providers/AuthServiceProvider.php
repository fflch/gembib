<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logado', function ($user) {
            return true;
        });

        /* Serviço de Aquisição e Intercâmbio  */
        Gate::define('sai', function ($user) {
            $sai = explode(',', trim(config('gembib.sai')));
            return ( in_array($user->codpes, $sai) and $user->codpes );
        });

        /* Serviço Técnico de Livros */
        Gate::define('stl', function ($user) {
            $stl = explode(',', trim(config('gembib.stl')));
            return ( in_array($user->codpes, $stl) and $user->codpes );
        });
    }
}
