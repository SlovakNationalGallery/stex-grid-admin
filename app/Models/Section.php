<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class)->orderByPivot('ord');
    }
}
