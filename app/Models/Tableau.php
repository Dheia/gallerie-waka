<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Waka\YamlForms\YamlFormsTrait;
use Waka\YamlForms\YamlFormsInterface;

class Tableau extends Model implements HasMedia, Sortable, YamlFormsInterface
{
    use HasFactory;
    use InteractsWithMedia;
    use SortableTrait;
    use YamlFormsTrait;



    protected $fillable = [
        'name',
        'slug',
        'description',
        'image'
    ];

    public function tableauTags()
    {
        return $this->belongsToMany(TableauTag::class);
    }


    /**
     * SCOPE
     */
    public function scopeInTags($query, $scopeSlugs)
    {
        logger("scopeInTags");
        logger($scopeSlugs);
        if (is_string($scopeSlugs)) $scopeSlugs = explode(",", $scopeSlugs);
        logger($scopeSlugs);
        //return $query;
        return $query->whereHas('tableauTags', function ($query) use ($scopeSlugs) {
            $query->whereIn('slug', $scopeSlugs);
        });
    }

    public function scopeAllTags($query, $scopeSlugs)
    {
        if (is_string($scopeSlugs)) $scopeSlugs = explode(",", $scopeSlugs);
        return $query->whereHas('tableauTags', function ($query) use ($scopeSlugs) {
            $query->select(\DB::raw('count(*) as tableau_id'))
            ->whereIn('slug', $scopeSlugs)
            ->groupBy('tableau_id');
        }, '=', count($scopeSlugs));
    }

    /**
     * GETTERS
     */

    public function getThumbAttribute()
    {
        return $this->getFirstMediaUrl('image', 'minithumb');
    }
    public function getImageBigThumbAttribute()
    {
        return $this->getFirstMediaUrl('image', 'small');
    }
    public function getImageFullScreenAttribute()
    {
        return $this->getFirstMediaUrl('image', 'large');
    }
    public function getJoinTagsAttribute()
    {
        $tags =  $this->tableauTags()->pluck('name')->toArray();
        return implode(',', $tags);
    }
    public function getTagsPluckIdAttribute() {
       return  $this->tableauTags()->pluck('id')->toArray();
    }

    /**
     * Lists
     */
    public static function staticListTags() {
        return TableauTag::get(['name', 'id'])->toArray();
    }

    public function listTags() {
        return TableauTag::get(['name', 'id'])->toArray();
    }


    /**
     * MEDIAS
     */

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('minithumb')
            ->crop('crop-center', 100, 100)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('small')
            ->fit('contain', 600, 300)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('large')
            ->fit('contain', 1980, 1024)
            ->optimize()
            ->nonQueued();
    }
}
