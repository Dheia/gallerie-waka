<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageTag;
use Illuminate\Support\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request;

class PageController extends Controller
{
    private $orderInverted = true;

    public function index()
    {
        
        // logger(Page::extractFields($columnsConfig));

        $columnsConfig = Page::getColumnsConfig();
        $columnsMeta = Page::getColumnsMeta();
        

        $pagex = QueryBuilder::for(Page::class)
        ->defaultSort($columnsConfig['defaultOrder'])
        ->allowedSorts(['id', 'name', 'order_column',  'slug', 'updated_at'])
        ->paginate($columnsConfig['pagination'])
        ->withQueryString()
        ->through([Page::class, 'dataYamlColumnTransformer']);
        
        $inertiaData = [
            'pages' => $pagex,
            'metas' => $columnsMeta,
            'columnsConfig' => $columnsConfig,
            'sort' => Request::all('sort'),
            'filter' => Request::all('filter'),
        ];

        return Inertia::render('Pages/Index', $inertiaData);
    }

   

    public function edit(Page $page)
    {
        logger($page->metas);
        $inertiaData = [
            'formData' => $page->dataYamlFieldsTransformer(),
            'config' => $page->getModelFormConfig()
        ];

        logger($inertiaData);
       return $inertiaData;
    }


    public function create() {
        $inertiaData = [
            'formData' => Page::getEmptyForm(),
            'config' => Page::getStaticModelFormConfig()
        ];
        return $inertiaData;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //logger('store');
        $validationRules = Page::getStaticModelValidationRules();
        //logger(Request::all());
        $page = Page::create(Request::validate($validationRules));
        $page->processImage(Request::get('image'));
        if($tags = Request::get('tableauTags')) {
            $page->tableauTags()->sync($tags);
        }
        return to_route('pages.index')->with('message', 'Page crée');
        
    }

   



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page)
    {
        $validationRules = $page->getModelValidationRules();
        $page->update(Request::validate($validationRules));
        $page->processImage(Request::get('image'));
        if($tags = Request::get('tableauTags')) {
            $page->tableauTags()->sync($tags);
        }
        // return redirect()->back()->with('message', 'Page  mis à jour');;
        return to_route('pages.index')->with('message', 'Page mis à jours');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->with('message', 'Page deleted');
    }

    public function moveOrder(Page $page) {
        $page->moveOrder(Request::get('mode'));
    }
}
