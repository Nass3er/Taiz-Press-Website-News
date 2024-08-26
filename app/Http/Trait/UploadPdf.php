<?php

namespace App\Http\Trait;

use \Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
trait UploadPdf
{

    public function upload_pdf($file, $categoryName)
{
    if (is_array($file)) {
        $paths = [];

        foreach ($file as $pdf) {
            $filename = Str::uuid() . $pdf->getClientOriginalName();

            // Create the category folder if it doesn't exist
            $categoryPath = public_path('pdfs/' . $categoryName);

            if (!File::exists($categoryPath)) {
                File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
            }

            // Move the PDF file to the category folder
            $pdf->move($categoryPath, $filename);

            $path = 'pdfs/' . $categoryName . '/' . $filename;
            $paths[] = $path;
        }

        return $paths;
    } else {
        $filename = Str::uuid() . $file->getClientOriginalName();

        // Create the category folder if it doesn't exist
        $categoryPath = public_path('pdfs/' . $categoryName);

        if (!File::exists($categoryPath)) {
            File::makeDirectory($categoryPath, 0755, true); // Create with recursive permissions
        }

        // Move the PDF file to the category folder
        $file->move($categoryPath, $filename);

        $path = 'pdfs/' . $categoryName . '/' . $filename;
        return $path;
    }
}

}