<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Stevebauman\Location\Facades\Location;
use App\Models\Visitor;


class IndexController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->isMethod('get')) {
            $location = Location::get($request->ip);
        //    dd($location->countryName);
           $visitor = Visitor::updateOrCreate(
            ['ip_address' => $request->ip()],
            [
                'visits' => Visitor::where('ip_address', $request->ip())->value('visits') + 1,
                'country' =>$location->countryName ?? null,
            ]
          );
        }

        $categories_with_posts = Category::with(['posts' => function ($query) {
            $query->latest();
        }])->get();

         // Add share buttons to each post
    foreach ($categories_with_posts as $category) {
        foreach ($category->posts as $post) {
            $slug = $post->translations->where('locale', app()->getLocale())->first()->slug;
            $postUrl = url("/post/{$post->id}/{$slug}");
            $shareButtons = \Share::page($postUrl, $post->title)
                ->facebook()
                ->telegram()
                ->twitter()
                ->whatsapp();

            $post->shareButtons = $shareButtons;
            $post->postUrl = $postUrl;
        }
    }
      // return view('website.index' , compact('categories_with_posts'));
       return view('website2.index' , compact('categories_with_posts'));
    }
}
