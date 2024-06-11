<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'perex', 'text'];

    public function items()
    {
        return $this->belongsToMany(Item::class)->orderByPivot('ord');
    }
}
