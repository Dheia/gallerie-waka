<?php 
namespace App\Values;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class PageStaticOptions extends CastableDataTransferObject
{
    public ?string $redirect;
    public bool $image;
    public string $contentMode;
}