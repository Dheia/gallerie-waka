<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Waka\YamlForms\YamlFormsTrait;
use Waka\YamlForms\YamlFormsInterface;

class Page extends Model implements HasMedia, YamlFormsInterface
{
    use HasFactory;
    use InteractsWithMedia;
    use YamlFormsTrait;



    protected $fillable = [
        'name',
        'slug',
        'title',
        'image',
        'metas',
        'options',
        'content'
    ];


    protected $casts = [
        'metas' => 'array',
        'options' => 'array'
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
