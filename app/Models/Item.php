<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use HasTranslations;


    public $incrementing = false;

    protected $keyType = 'string';

    public $translatable = [];

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

}
