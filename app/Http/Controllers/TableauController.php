<?php

namespace App\Http\Controllers;

use App\Models\Tableau;
use App\Models\TableauTag;
use Illuminate\Support\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request;

class TableauController extends Controller
{
    private $orderInverted = true;

    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query->orWhere('name', 'LIKE', "%{$value}%");
                    $query->orWhere('slug', 'LIKE', "%{$value}%");
                    $query->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        // logger(Tableau::extractFields($columnsConfig));

        $columnsConfig = Tableau::getColumnsConfig();
        $columnsMeta = Tableau::getColumnsMeta();
        

        $tableaux = QueryBuilder::for(Tableau::class)
        ->defaultSort($columnsConfig['defaultOrder'])
        ->allowedSorts(['id', 'painted_at','name', 'order_column',  'slug', 'updated_at'])
        ->allowedFilters([$globalSearch])
        ->paginate($columnsConfig['pagination'])
        ->withQueryString()
        ->through([Tableau::class, 'dataYamlColumnTransformer']);
        
        $inertiaData = [
            'tableaux' => $tableaux,
            'metas' => $columnsMeta,
            'columnsConfig' => $columnsConfig,
            'sort' => Request::all('sort'),
            'filter' => Request::all('filter'),
        ];

        return Inertia::render('Tableaux/Index', $inertiaData);
    }

   

    public function edit(Tableau $tableau)
    {
        $inertiaData = [
            'formData' => $tableau->dataYamlFieldsTransformer(),
            'config' => $tableau->getModelFormConfig()
        ];
        return Inertia::render('Tableaux/Edit', $inertiaData);
    }


    public function create() {
        $inertiaData = [
            'formData' => Tableau::getEmptyForm(),
            'config' => Tableau::getStaticModelFormConfig()
        ];
        return Inertia::render('Tableaux/Create', $inertiaData);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validationRules = Tableau::getStaticModelValidationRules();
        $tableau = Tableau::create(Request::validate($validationRules));
        $tableau->processImage(Request::get('image'));
        if($tags = Request::get('tableauTags')) {
            $tableau->tableauTags()->sync($tags);
        }
        return to_route('tableaux.index')->with('message', 'Tableau crée');
        
    }

   



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableauRequest  $request
     * @param  \App\Models\Tableau  $tableau
     * @return \Illuminate\Http\Response
     */
    public function update(Tableau $tableau)
    {
        //logger('update');
        $validationRules = $tableau->getModelValidationRules();
        $tableau->update(Request::validate($validationRules));
        $tableau->processImage(Request::get('image'));
        if($tags = Request::get('tableauTags')) {
            $tableau->tableauTags()->sync($tags);
        }
        // return redirect()->back()->with('message', 'Tableau  mis à jour');;
        return to_route('tableaux.index')->with('message', 'Tableau mis à jours');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tableau  $tableau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tableau $tableau)
    {
        $tableau->delete();
        return redirect()->back()->with('message', 'Book deleted');
    }

    public function moveOrder(Tableau $tableau) {
        $tableau->moveOrder(Request::get('mode'));
    }
}
