<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Tableau extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('minithumb')
              ->crop('crop-center', 100, 100)
              ->nonQueued();

        $this->addMediaConversion('old-picture')
              ->sepia()
              ->border(10, 'black', Manipulations::BORDER_OVERLAY)
              ->nonQueued();
              
        $this->addMediaConversion('thumb-cropped')
            ->crop('crop-center', 400, 400)
            ->nonQueued(); // Trim or crop the image to the center for specified width and height.
    }

    public function getThumbAttribute() {
        return $this->getFirstMediaUrl('images', 'minithumb');
    }
}
