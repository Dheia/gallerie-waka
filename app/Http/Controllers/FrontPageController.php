<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;

class FrontPageController extends Controller
{
    public function get($slug)
    {
        logger('get slug : '.$slug);
        $page =  Page::where('slug', $slug)->first();
        return Inertia::render('FrontPage', ['page' => $page->dataYamlFieldsTransformer()]);
    }
}
