<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function show($item_id)
    {
        $user = auth()->user();

        return view('purchase.address',compact('user','item_id'));
    }

    public function store(AddressRequest $request, $item_id)
    {
        session(['address_data' => $request->only('zip_code', 'address', 'building')]);

        return redirect(route('purchase.show',$item_id));
    }
}
