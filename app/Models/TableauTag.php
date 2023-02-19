<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class TableauTag extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    public function tableaux()
    {
        return $this->belongsToMany(Tableau::class);
    }
}


