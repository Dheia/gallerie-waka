<?php

namespace App\Http\Controllers;

use App\Models\Tableau;
use Illuminate\Support\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use \App\Http\Requests\StoreTableauRequest;
use \App\Http\Requests\UpdateTableauRequest;
use \App\Http\Resources\TableauResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TableauController extends Controller
{
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
        $tableaux = QueryBuilder::for(Tableau::class)
        ->defaultSort('-updated_at')
        ->allowedSorts(['name', 'id', 'updated_at'])
        ->allowedFilters(['name', $globalSearch])
        ->with('media')
        ->paginate(request('perPage'))
        ->withQueryString()
        ->through(fn ($tableau) => [
            'id' => $tableau->id,
            'name' => $tableau->name,
            'description' => $tableau->description,
            'medias' => $tableau->media,
            'updated_at' => $tableau->updated_at,
            'images' => $tableau->thumb,
        ]);
        

        return Inertia::render('Tableaux/Index', ['tableaux' => $tableaux])->table(function (InertiaTable $table) {
            $table->withGlobalSearch();
            $table->column('id', 'ID', searchable: true, sortable: true);
            $table->column('name', 'Nom du tableau', searchable: true, sortable: true);
            $table->column('name', 'Nom du tableau', searchable: true, sortable: true);
            $table->column('updated_at', 'MAJ', searchable: true, sortable: true);
            $table->column('actions', 'Actions');
            $table->column('images', 'Images');
        });
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        \Log::info('store');
        \Log::info($request);
        $tableau = Tableau::create(
            $request->validate([
                'name' => ['required', 'max:50'],
                'description' => ['required', 'max:500'],
                'image'
            ])
        );
        \Log::info('store 2');
        $this->processImage($request, $tableau);
        \Log::info('store 3');
        return to_route('tableaux.index')->with('message', 'Livre crée');;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableauRequest  $request
     * @param  \App\Models\Tableau  $tableau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tableau $tableau)
    {
        \Log::info('update---------------------');
        \Log::info($request);

        $tableau->update($request->validate([
            'name' => ['required', 'max:50'],
            'description' => ['required', 'max:500'],
            ])
        );
        $this->processImage($request, $tableau);

        // return redirect()->back()
        //     ->with('message', 'Book updated');
        return to_route('tableaux.index')->with('message', 'Livre MAJ');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tableau  $tableau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tableau $tableau)
    {
        \Log::info("destroy");
        \Log::info($tableau->name);
        $tableau->delete();
        return redirect()->back()
            ->with('message', 'Book deleted');
    }

    public function getThumb($modelId) {
        $tableau = null;
        if($modelId) {
            \Log::info($modelId);
            return Media::find($modelId)->getUrl('minithumb');
        } else {
            return null;
        }
    }

    

    protected function processImage(Request $request, $model = null)
    {
        \Log::info("processImage : ".$model->name);
        \Log::info($request);

        $image = $request->get('image');
        if($image && $model)
        {
            $path = storage_path('app/public/' . $image);
            //\Log::info($path);
            if(file_exists($path)){
                //\Log::info('creation');
                //$model->clearMediaCollection();
                $model->addMedia($path)->toMediaCollection('images');
            }
        }
    }
}
