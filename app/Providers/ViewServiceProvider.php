<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         // ===== View Share =====
        // if(Schema::hasTable('categories')){
        //     View::share('categories', Category::all());
        // }

        // ===== View Composer =====
        View::composer(['posts.create', 'posts.edit'], function(){
            View::share('categories', Category::all());
        });

         // ===== Custom Blade =====
        // Blade::directive('nsm', function(){
        //     return "<h3>Hello Min</h3>";
        // });
    }
}
