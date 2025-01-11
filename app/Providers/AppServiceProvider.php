<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(FakerGenerator::class, function () {
            $faker = FakerFactory::create();
            $faker->seed(mt_rand()); // Randomize seed to prevent collisions
            return $faker;
        });
    }
}
