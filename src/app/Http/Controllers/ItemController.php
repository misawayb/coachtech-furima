<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Http\Requests\ExhibitionRequest;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemCategory;
use App\Models\Comment;

class ItemController extends Controller
{
    public function index()
    {
        $tab = request()->query('tab');
        $keyword = request()->query('keyword');

        if ($tab === 'mylist') {
            if (auth()->id() === null) {
                $items = collect();
            } else {
                $items = auth()->user()->likedItems;
            }
        } else {
            if (auth()->id() === null) {
            $items = Item::all();
            } else {
            $items = Item::where('user_id', '!=', auth()->id())->get();
            }
        }
        if($keyword){
            $items = $items->filter(fn($item) => str_contains($item->name, $keyword));
        }

        return view('item.index', compact('items','keyword'));
    }


    public function create()
    {
        $conditions = Condition::cases();
        $categories = Category::all();
        return view('item.sell',compact('conditions','categories'));
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
    public function show($item_id)
    {
        $item = Item::with(['likes', 'comments.user', 'categories'])->findOrFail($item_id);

        return view('item.detail',compact('item'));
    }
}
