<?php

namespace App\Http\Trait;

use \Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;
trait UploadImage
{
    // hundle single or multiple images
    public function uploadImage($file, $categoryName)
    {
          
        if (is_array($file)) {
            $paths = [];
    
            foreach ($file as $image) {
                // $filename = Str::uuid() . $image->getClientOriginalName();

                $filename = Str::uuid() . '.webp' ;
                
                // Create the category folder if it doesn't exist
                $categoryPath = public_path('images/' . $categoryName);
                if (!File::exists($categoryPath)) {
                    File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
                }
    
                // $image->move($categoryPath, $filename);
                 // Convert to WebP using Intervention Image
                 $image = Image::make($image)       // convert to webp
                 ->encode('webp')
                 ->save($categoryPath . '/' . $filename);
     
                $path = 'images/' . $categoryName . '/' . $filename;
                $paths[] = $path;
            }
    
            return $paths;
        } else {
             
            $filename = Str::uuid() . '.webp' ;
    
            // Create the category folder if it doesn't exist
            $categoryPath = public_path('images/' . $categoryName);
            if (!File::exists($categoryPath)) {
                File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
            }
    
            // $file->move($categoryPath, $filename);
            $image = Image::make($file)
            ->encode('webp')
            ->save($categoryPath . '/' . $filename);

            $path = 'images/' . $categoryName . '/' . $filename;
            return $path;
        }
    }
    
}



///////////if we want resize with convert to webp /////////////
 // Resize and convert to WebP using Intervention Image
//  $image = Image::make($image)
//  ->resize(800, null, function ($constraint) {
//      $constraint->aspectRatio();
//  })
//  ->encode('webp')
//  ->save($categoryPath . '/' . Str::uuid() . '.webp');

