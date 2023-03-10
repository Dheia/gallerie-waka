<?php

namespace App\Http\Controllers;

use App\Models\TableauTag;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Support\Facades\Request;

class TableauTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnsConfig = TableauTag::getColumnsConfig();


        $tableauTags = QueryBuilder::for(TableauTag::class)
        ->defaultSort($columnsConfig['defaultOrder'])
        ->allowedSorts(['name', 'id'])
        ->withCount('tableaux')
        ->paginate(request('perPage'))
        ->withQueryString()
        ->through([TableauTag::class, 'dataYamlColumnTransformer']);
        return Inertia::render('TableauTags/Index', ['tableauTags' => $tableauTags]);
    }

    public function getall()
    {
        return TableauTag::get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //logger('create');
        $inertiaData = [
            'formData' => TableauTag::getEmptyForm(),
            'config' => TableauTag::getStaticModelFormConfig()
        ];
        //logger($inertiaData);
        return $inertiaData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //logger('store');
        $validationRules = TableauTag::getStaticModelValidationRules();
        //logger($validationRules);
        //logger(Request::all());
        $tableau = TableauTag::create(Request::validate($validationRules));
        return redirect()->back()->with('message', 'Un nouveau tag a été crée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TableauTag  $tableauTag
     * @return \Illuminate\Http\Response
     */
    public function show(TableauTag $tableauTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TableauTag  $tableauTag
     * @return \Illuminate\Http\Response
     */
    public function edit(TableauTag $tableauTag)
    {
        //logger("edit : ".$tableauTag->name);
        $inertiaData = [
            'formData' => $tableauTag->dataYamlFieldsTransformer(),
            'config' => $tableauTag->getModelFormConfig()
        ];
        return $inertiaData;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TableauTag  $tableauTag
     * @return \Illuminate\Http\Response
     */
    public function update(TableauTag $tableauTag)
    {
        //logger('update');
        $validationRules = $tableauTag->getModelValidationRules();
        $tableauTag->update(Request::validate($validationRules));
        // return redirect()->back()->with('message', 'Tableau  mis à jour');;
        return redirect()->back()->with('message', 'tag MAJ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TableauTag  $tableauTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableauTag $tableauTag)
    {
        $tableauTag->delete();
        return redirect()->back()->with('message', 'tag deleted');
    }

    public function newOrder() {
        $order = Request::get('order');
        //logger($order);
        TableauTag::setNewOrder($order);
        return redirect()->back()
            ->with('message', 'MAJ ordre');
    }
}
