<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Models\Purchase;
use App\Models\Item;
use App\Http\Requests\PurchaseRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $user = auth()->user();
        $item = Item::find($item_id);
        if (session('address_data')) {
            $address_delivery = session('address_data');
        } else {
            $address_delivery = [
                'zip_code' => $user->zip_code,
                'address' => $user->address,
                'building' => $user->building,
            ];
        }
        $payment_methods = PaymentMethod::cases();

        return view('purchase.detail',compact('user','item','address_delivery', 'payment_methods'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $data = $request->only('payment_method','zip_code','address','building');
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['item_id'] = $item_id;

        session(['purchase_data' => $data]);

        $item = Item::find($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', $item_id),
            'cancel_url' => route('purchase.cancel', $item_id),
        ]);

        return redirect($stripeSession->url);
    }

    public function success($item_id)
    {
        $data = session('purchase_data');
        Purchase::create($data);

        return redirect()->route('item.index');
    }

    public function cancel($item_id)
    {
        return redirect()->route('purchase.show', $item_id);
    }
}
