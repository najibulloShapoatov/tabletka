<?php

namespace App\Providers;


use App\Model\Cart;
use App\Model\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // frontend
        View::composer('*', function ($view) {


            // user info
            $userData = [];
            $categories =[];
            $wishlists =(new Cart())->getWishlist();



            if(!empty(Auth::user()->id)) {
                $userData = (new User )->getByID(Auth::user()->id);
            }

            $categories = (new Category())->getList();


            $view->with([
                'userInfo' => $userData,
                'categories' => $categories,
                'wishlists'=>$wishlists,
            ]);

        });
    }
}
