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
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        if($this->orderInverted)  {
            $defaultSort = '-order_column';
        } else {
            $defaultSort = 'order_column';
        }
        $tableaux = QueryBuilder::for(Tableau::class)
        ->defaultSort($defaultSort)
        ->allowedSorts(['name', 'order_column', 'updated_at'])
        ->allowedFilters(['name', 'description', $globalSearch])
        ->with('media')
        ->paginate(request('perPage'))
        ->withQueryString()
        ->through([Tableau::class, 'dataYamlColumnTransformer']);;
        

        return Inertia::render('Tableaux/Index', ['tableaux' => $tableaux])->table(function (InertiaTable $table) {
            $table
            ->column(key:'order_column', label:'Ordre', sortable: true)
            ->column(key:'name', label:'Nom du tableau', searchable: true, sortable: true);
            
        });
    }

    public function edit(Tableau $tableau)
    {
        return  [
            'tableau' => [
                'id' => $tableau->id,
                'name' => $tableau->name,
                'description' => $tableau->description,
                'image' => $tableau->getFirstMediaUrl('images'),
                'tableauTags' => $tableau->tableauTags,
            ],
            'tableauTags' => TableauTag::get(),
        ];
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tableau = Tableau::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'description' => ['required', 'max:500'],
            ])
        );
        // \Log::info('store 2');
        $this->processImage(Request::get('image'), $tableau);
        if($tags = Request::get('tagIds')) {
            $tableau->tableauTags()->sync($tags);
        }
        // \Log::info('store 3');
        return to_route('tableaux.index')->with('message', 'Tableau crée');;
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
        $tableau->update(
            Request::validate([
                'name' => ['required', 'max:50'],
                'description' => ['required', 'max:500'],
            ])
        );

        $this->processImage(Request::get('image'), $tableau);
        if($tags = Request::get('tagIds')) {
            $tableau->tableauTags()->sync($tags);
        }

        // return redirect()->back()
        //     ->with('message', 'Book updated');
        return redirect()->back()->with('message', 'Tableau  mis à jour');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tableau  $tableau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tableau $tableau)
    {
        logger($tableau);
        $tableau->delete();
        return redirect()->back()
            ->with('message', 'Book deleted');
    }

    

    protected function processImage($image = null, $model = null)
    {
        if($image && $model)
        {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)) {
                logger('nouveau  fichier, je met  à jour !');
                $model->addMedia($path)->toMediaCollection('images');
            } else {
                logger('pas de fichier, je ne met rien à jour !');
            }
        } else {
            if($model) {
                $model->getFirstMedia('images')->delete();
            }
        }
    }


    public function moveOrder(Tableau $tableau) {
        $mode = Request::get('mode');
        if($this->orderInverted)  {
            if($mode == 'up') $tableau->moveOrderDown();
            if($mode =='down') $tableau->moveOrderUp();
            if($mode =='start') $tableau->moveToEnd();
            if($mode =='end') $tableau->moveToStart();
        } else {
            if($mode == 'up') $tableau->moveOrderUp();
            if($mode =='down') $tableau->moveOrderDown();
            if($mode =='start') $tableau->moveToStart();
            if($mode =='end') $tableau->moveToEnd();
        }
        $tableau->save();
    }
}
