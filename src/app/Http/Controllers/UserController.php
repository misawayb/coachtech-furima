<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('mypage/profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->only('name', 'zip_code', 'address', 'building',));

        if($request->hasFile('profile_image')){
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        return redirect('mypage/profile');
    }

    public function show()
    {
        $user = auth()->user();
        $tab = request('page', 'sell');

        if($tab==='buy')
            {
                $items = $user->purchases->pluck('item');
            } else {
                $items = $user->items;
            }

        return view('mypage.index',compact('user', 'items','tab'));
    }
}
