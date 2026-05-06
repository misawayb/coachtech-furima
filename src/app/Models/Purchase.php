<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'zip_code', 'address', 'building', 'payment_method'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
