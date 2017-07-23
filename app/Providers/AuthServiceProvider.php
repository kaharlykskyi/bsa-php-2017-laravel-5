<?php

namespace App\Providers;

use App\Entity\Car;
use App\Policies\CarPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register a policy for car entity.
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Car::class => CarPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
