<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

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
