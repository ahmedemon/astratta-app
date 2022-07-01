<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function edit()
    {
        $pageTitle = "Edit Billing Address";
        $billing = BillingDetail::where('user_id', Auth::user()->id)->first();
        return view('frontend.my-account.edit-billing', compact('pageTitle', 'billing'));
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

        $billing_details = BillingDetail::find($id);
        $billing_details->update($request->except('_token', '_method'));
        alert('Success!', 'Billing details updated successfully!', 'success');
        return redirect()->route('my-account.index');
    }
}
