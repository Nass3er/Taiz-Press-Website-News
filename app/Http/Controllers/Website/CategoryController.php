<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Trait\AddLinksSharToPost ;
use Illuminate\Database\Eloquent\Collection;


class CategoryController extends Controller
{
    use AddLinksSharToPost ;
    public function show(Category $category)
    {
        $category = $category->load('children');
       $posts = Post::where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        
        $posts->each(function ($post) {                      // نمر على كل البوستات ونضيفلهم روبط المشاركة عبر مواقع التواصل
            $postUrl = url("/post/{$post->id}/{$post->slug}");
    
            $shareButtons = \Share::page($postUrl, $post->title)  
                ->facebook()
                ->telegram()
                ->twitter()
                ->whatsapp();
    
            $post->shareButtons = $shareButtons;
            $post->postUrl = $postUrl;
        });
     
        return view('website2.category', compact('category', 'posts'));
    }
}
