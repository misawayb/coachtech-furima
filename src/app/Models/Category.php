<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function item_categories()
    {
        return $this->hasMany(ItemCategory::class);
    }
}
