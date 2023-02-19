<?php 
namespace App\Values;

use JessArcher\CastableDataTransferObject\CastableDataTransferObject;

class PageMetas extends CastableDataTransferObject
{
    public string $resume;
    public string $author;
    public string $keyWord;
}