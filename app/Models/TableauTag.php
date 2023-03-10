<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Waka\YamlForms\YamlFormsTrait;
use Waka\YamlForms\YamlFormsInterface;
class TableauTag extends Model implements Sortable, YamlFormsInterface
{
    use HasFactory;
    use SortableTrait;
    use YamlFormsTrait;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function tableaux()
    {
        return $this->belongsToMany(Tableau::class);
    }

    public function getCountTableauxAttribute()
    {
        return $this->tableaux->count();
    }
}


