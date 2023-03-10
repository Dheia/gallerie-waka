<?php

namespace App\Http\Controllers;

use App\Models\Tableau;
use App\Models\TableauTag;
use App\Models\Page;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    private $orderInverted = true;

    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        if ($this->orderInverted) {
            $defaultSort = '-order_column';
        } else {
            $defaultSort = 'order_column';
        }

        $tagMode = Request::get('tagMode');

        $scope = null;
        if(!$tagMode || $tagMode== 'OU' ) {
            $scope = AllowedFilter::scope('inTags');
        } else {
            $scope = AllowedFilter::scope('inTags', 'allTags');
        }

        $tableaux = QueryBuilder::for(Tableau::class)
            ->defaultSort($defaultSort)
            ->allowedSorts(['name', 'order_column', 'updated_at'])
            ->allowedFilters([$globalSearch, $scope])
            ->paginate(100)
            ->withQueryString()
            ->through(fn ($tableau) => [
                'id' => $tableau->id,
                'name' => $tableau->name,
                'slug' => $tableau->slug,
                'image_big_thumb' => $tableau->imageBigThumb,
            ]);

        $page = Page::where('slug', 'accueil')->first();
        $page['image'] = $page->image;
            
        $return =   [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'tableaux' => $tableaux,
            'allTags' => TableauTag::ordered()->get(),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'filter' => Request::get('filter'),
            'tagMode' => Request::get('tagMode'),
            'page' => $page,
        ];


        return Inertia::render('Welcome',$return);


        

    }


    public function get($slug) {
        // logger($tableau->toArray());
        $tableauAll = Tableau::with('tableauTags')->where('slug', $slug)->first();
        // logger($tableauAll->toArray());
        return Inertia::render('Tableau',[
            'data' => $tableauAll,
            'url' =>  $tableauAll->imageFullScreen,
        ]);
    }
}
