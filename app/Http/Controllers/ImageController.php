<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Spatie\MediaLibrary\Models\Media;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        \Log::info('UPLOAD');
        \Log::info($request);
        if($request->hasFile('imageFilepond'))
        {
            $path = $request->file('imageFilepond')->store('uploads/temp', 'public');
            //\Log::info($path);
            return $path;
        }
        return '';
    }

    public function uploadRevert(Request $request)
    {
        if($image = $request->get('image')) {
            $path = storage_path('app/public/' . $image);
            //\Log::info("path to delete");
            //\Log::info($path);
            if(file_exists($path)){
                unlink($path);
            }
        }
        return '';
    }

    

    
}
