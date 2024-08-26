<?php

namespace App\Http\Trait;

use \Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
trait AddLinksSharToPost 
{
    public function addLinksToPost(Collection $data)
{
    foreach ($data as $item) {
        // Access properties using object syntax, as $data is a collection of objects
       
        $slug = $item->slug ?? "random";

        // Generate URL and share buttons if necessary (logic remains the same)
        $url =  url("/post/{$item->id}/{$slug}") ;
        $item->shareButtons  = \Share::page($url, $item->title)
                                       ->facebook()
                                       ->telegram()
                                       ->twitter()
                                       ->whatsapp();
                                     
        $item->postUrl = $url;
    }

    return $data;
}

}

 