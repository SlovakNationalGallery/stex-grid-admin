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
        return $this->belongsToMany(Item::class)->orderByPivot('ord')->withPivot('ord');
    }

    public function items_with_position() {
        return $this->belongsToMany(Item::class)->orderByPivot('ord')->whereNotNull('x')->whereNotNull('y')->withPivot('ord');
    }
}
