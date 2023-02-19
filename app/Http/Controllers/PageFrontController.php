<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Request;
use App\Models\Page;
use Illuminate\Support\Collection;
use Inertia\Inertia;


class PageFrontController extends Controller
{
    public function get($pageSlug) {
        $page = Page::where('slug', $pageSlug)->first();
        return Inertia::render('Page', ['page' => $page]);
    }
}



