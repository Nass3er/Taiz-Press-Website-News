<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostTranslation;

class PostController extends Controller
{
    public function show(Post $post)
{ 
    views($post)->record();
    // Get the slug from the appropriate PostTranslation for the current language
    $slug = $post->translations->where('locale', app()->getLocale())->first()->slug;

    $postUrl = url("/post/{$post->id}/{$post->slug}");

    $shareButtons = \Share::page($postUrl,'here a text',)
        ->facebook()
        ->telegram()
        ->twitter()
        ->whatsapp();
        
    // Get related posts based on category and tags
    $categoryId = $post->category->id;
    $tags = explode(' ', $post->tags);
    $relatedPosts = Post::whereHas('category', function ($query) use ($post) {
    $query->where('id', $post->category->id);
})
->orWhereHas('translations', function ($query) use ($post) {
    $tags = explode(' ', $post->tags);
    foreach ($tags as $tag) {
        $query->orWhere('tags', 'LIKE', '%' . $tag . '%');
    }
})
    ->where('id', '!=', $post->id) // Exclude the current post
    ->latest()
    ->take(5)
    ->get();
        // dd($shareButtons);
    return view('website2.post', compact('post', 'shareButtons', 'postUrl', 'relatedPosts'));
}


public function showUrl( Post $post){
     // Get the slug from the appropriate PostTranslation for the current language
     $slug = $post->translations->where('locale', app()->getLocale())->first()->slug;

     $postUrl = url("/post/{$post->id}/{$post->slug}");
 
     $shareButtons = \Share::page($postUrl,'here a text',)
         ->facebook()
         ->telegram()
         ->twitter()
         ->whatsapp();
         
         // dd($shareButtons);
     return view('website2.post', compact('post', 'shareButtons','postUrl'));
}


public function showPostsByTag($tag)
{
    $posts = Post::whereHas('translations', function ($query) use ($tag) {
        $query->where('tags', 'LIKE', '%' . $tag . '%');
    })
    ->latest()
    ->take(30)
    ->get();
    
    return view('website2.byTag', compact('posts','tag'));
}

}
