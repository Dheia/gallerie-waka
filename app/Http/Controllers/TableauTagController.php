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
    private $orderInverted = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('slug', 'LIKE', "%{$value}%");
                });
            });
        });
         if($this->orderInverted)  {
            $defaultSort = '-order_column';
        } else {
            $defaultSort = 'order_column';
        }
        $tableauTags = QueryBuilder::for(TableauTag::class)
        ->defaultSort($defaultSort)
        ->allowedSorts(['name', 'id', 'updated_at'])
        ->withCount('tableaux')
        ->paginate(request('perPage'))
        
        ->withQueryString();

        logger($tableauTags);
        

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TableauTag  $tableauTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableauTag $tableauTag)
    {
        //
    }

    public function newOrder() {
        $order = Request::get('order');
        logger($order);
        TableauTag::setNewOrder($order);
        return redirect()->back()
            ->with('message', 'MAJ ordre');
    }
}
