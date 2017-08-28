<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Make sure any subcategoy chosen matches the category chosen (can be chosen separately)
        Validator::extend('category', function ($attribute, $value, $parameters, $validator) {
            $request = Request::capture();
            if($request->input('subcategory')) {
                return \App\Subcategory::find($request->input('subcategory'))->category_id == $request->input('category');
            }
            else {
                return true;
            }
        });

        // Make sure slug is not used already
        Validator::extend('uniqueSlug', function($attribute, $value, $parameters, $validator) {
            $request = Request::capture();

            if($attribute == 'id') {
                $used = \App\Post::where('id', '<>', $value)
                    ->where('slug', str_slug($request->input('title')))
                    ->count();
            }
            else {
                $used = \App\Post::where('slug', str_slug($request->input('title')))
                    ->count();
            }

            if($used) {
                return false;
            }
            else {
                return true;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
