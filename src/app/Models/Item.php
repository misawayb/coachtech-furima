<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id','name','price','brand','description','image','condition'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function item_categories()
    {
        return $this->hasMany(ItemCategory::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
