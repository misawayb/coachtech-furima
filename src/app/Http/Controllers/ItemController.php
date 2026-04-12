<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemCategory;

class ItemController extends Controller
{
    public function create()
    {
        $conditions = Condition::cases();
        $categories = Category::all();
        return view('sell',compact('conditions','categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $data = $request->only('name', 'description', 'condition', 'price', 'brand');
        $category = $request->input('category');
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $imagePath = $request->file('sell_image')->store('items', 'public');
        $data['image'] = $imagePath;
        $item = Item::create($data);

        foreach ($category as $category_id) {
            ItemCategory::create([
                'item_id' => $item->id,
                'category_id' => $category_id,
            ]);
        }
        return redirect('/');
    }
}
