<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'item_id', 'zip_code', 'address', 'buildeing', 'payment_method'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
