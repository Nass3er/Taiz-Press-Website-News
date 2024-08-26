<?php

namespace App\Http\Trait;

use \Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use VideoThumbnail;
use Image;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
trait UploadVideo
{

    public function upload_video($file, $categoryName)
{
    if (is_array($file)) {
        $paths = [];
 
        foreach ($file as $video) {
            $filename = Str::uuid() . $video->getClientOriginalName();

            // Create the category folder if it doesn't exist
            $categoryPath = public_path('videos/' . $categoryName);
     
            if (!File::exists($categoryPath)) {
                File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
            }

            // Move the video file to the category folder
            $video->move($categoryPath, $filename);
            
            // Generate a thumbnail for the video
            $thumbnailFilename = Str::uuid() . '.jpg';
            $thumbnailPath = public_path('thumbnails/');

            if (!File::exists($thumbnailPath)) {
                File::makeDirectory($thumbnailPath, 0755, true); // Create with recursive permissions
            }


            $videoFilePath = $categoryPath . '/' . $filename;

           
            VideoThumbnail::createThumbnail(
                $videoFilePath,
                $thumbnailPath ,
                $thumbnailFilename,
                2,   // Seconds to extract thumbnail from
                640, // Thumbnail width
                480  // Thumbnail height
            );

            $path = 'videos/' . $categoryName . '/' . $filename;
            $thumbnail = 'thumbnails/' . $thumbnailFilename;
            $paths[] = [
                'video' => $path,
                'thumbnail' => $thumbnail
            ];
        }

        return $paths;
    } else {

        $filename = Str::uuid() . $file->getClientOriginalName();
        // Create the category folder if it doesn't exist
        $categoryPath = public_path('videos/' . $categoryName);

        if (!File::exists($categoryPath)) {
            File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
        }

        // Move the video file to the category folder
        $file->move($categoryPath, $filename);

        // Generate a thumbnail for the video
        $thumbnailFilename = Str::uuid() . '.jpg';
        $thumbnailPath = public_path('thumbnails/');
     
        if (!File::exists($thumbnailPath)) {
            File::makeDirectory($thumbnailPath, 0755, true); // Create with recursive permissions
        }

        $videoFilePath = $categoryPath . '/' . $filename;

        VideoThumbnail::createThumbnail(
            $file,
            $thumbnailPath ,
            $thumbnailFilename,
            2,   // Seconds to extract thumbnail from
            640, // Thumbnail width
            480  // Thumbnail height
        );

       $path = 'videos/' . $categoryName . '/' . $filename;
       $thumbnail = 'thumbnails/' . $thumbnailFilename;
     
        return [
            'video' => $path,
            'thumbnail' => $thumbnail
        ];
     
}
}
}


