<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store($item_id)
    {
        $user_id = auth()->id();
        if (Like::where('item_id', $item_id)->where('user_id', $user_id)->exists()) {
            Like::where('item_id', $item_id)->where('user_id', $user_id)->delete();
        } else {
            Like::create(['item_id' => $item_id, 'user_id' => $user_id]);
        }
        return redirect(route('item.show', ['item_id' => $item_id]));
    }
}
