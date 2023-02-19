<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Values\PageMetas;
use App\Values\PageStaticOptions;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'metas' => PageMetas::class,
        'staticOptions' => PageStaticOptions::class,
    ];

    protected $fillable = [
        'name',
        'slug',
        'title',
        'metas',
        'options',
        'content'
    ];

    /**
     * RELATIONS
     */



    /**
     * SCOPES
    */


    /**
     * ATTRIBUTE
    */



    /**
     * REGISTER MEDIA
    */
    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('image');
    }
}
