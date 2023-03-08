<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Request;
use App\Models\Page;
use Illuminate\Support\Collection;
use Inertia\Inertia;


class PageController extends Controller
{
    public function index() {
        $pages = Page::get();
        
        $pages->each(function ($item, $key) {
            $item['image'] = $item->image;
        });
        return Inertia::render('Pages/Index', ['pages' => $pages]);
    }




    public function update(Page $page)
    {
        logger($page->name);
        logger(Request::only('title','name','slug' ));
        logger(Request::validate([
            'title' => ['required', 'max:250'],
            'name' => ['required', 'max:150'],
            'slug' => ['required', 'max:150'],
            'content' => ['required'],
            ]));
        $page->update(
            Request::validate([
            'title' => ['required', 'max:250'],
            'name' => ['required', 'max:150'],
            'slug' => ['required', 'max:150'],
            'content' => ['required'],
            ])
        );

        $this->processImage(Request::get('image'), $page);
        return to_route('pages.index')->with('message', 'Page  mis à jour');;
    }





    protected function processImage($image = null, $model = null)
    {
        if(!$model?->staticOptions->image) {
            return;
        }
        if($image && $model)
        {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)) {
                logger('nouveau  fichier, je met  à jour !');
                $model->addMedia($path)->toMediaCollection('image');
            } else {
                logger('pas de fichier, je ne met rien à jour !');
            }
        } else {
            if($model) {
                $model->getFirstMedia('image')->delete();
            }
        }
    }
}



