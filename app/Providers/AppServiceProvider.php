<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use App\Http\Trait\AddLinksSharToPost ;
class AppServiceProvider extends ServiceProvider
{
    use AddLinksSharToPost ;
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
        //
        if(!app()->runningInConsole()){

 
            Paginator::useBootstrap();
            $settings = Setting::checkSettings();
            $categories = Category::with('children')->where('parent' , 0)->orWhere('parent' , null)->get();
            $lastPost = Post::with('category','user')->orderBy('id','desc')->limit(1)->latest()->first();
            $lastFivePosts = Post::with('category','user')->orderBy('id','desc')->whereIn('category_id', [1,2,4,6,7,9])->limit(5)->get();
         
           
               
            View()->share([
                'setting'=>$settings,
                'categories'=>$categories,
                'lastFivePosts'=>$lastFivePosts,
                'lastPost' =>$lastPost,
                
            ]);
        }
         
        
    }
}
