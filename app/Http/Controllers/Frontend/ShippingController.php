<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function edit()
    {
        $pageTitle = "Edit Shipping Address";
        $shipping = ShippingDetail::where('user_id', Auth::user()->id)->first();
        return view('frontend.my-account.edit-shipping', compact('pageTitle', 'shipping'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'town_city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'post_or_zip' => ['required', 'string'],
        ]);

        $shipping_details = ShippingDetail::find($id);
        $shipping_details->update($request->except('_token', '_method'));
        alert('Success!', 'Shipping details updated successfully!', 'success');
        return redirect()->route('my-account.index');
    }
}
