<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('imageFilepond'))
        {
            return $request->file('imageFilepond')->store('uploads/books', 'public');
        }
        return '';
    }

    public function uploadRevert(Request $request)
    {
        if($image = $request->get('image')) {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)){
                unlink($path);
            }
        }
        return '';
    }

    protected function processImage(Request $request, $book = null)
    {
        if($image = $request->get('image'))
        {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)){
                copy($path, public_path($image));
                unlink($path);
            }
        }

        if($book)
        {
            if(!$request->get('image'))
            {
                if($book->image)
                {
                    if(file_exists(public_path($book->image))){
                        unlink(public_path($book->image));
                    }
                }
            }
            $book->update([
                'image' => $request->get('image')
            ]);
        }
    }
}