<?php

namespace App\Http\Controllers;
use App\Models\VirtualCurrency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VirtualCurrencyController extends Controller
{

    public function purchaseVerificationMark(Request $request)
{
    $user = auth()->user();
    $verificationMarkCost = 100; // Set the cost of the verification mark
    if ($user->virtualCurrency->balance >= $verificationMarkCost) {
        $user->virtualCurrency->decrement('balance', $verificationMarkCost);
        $user->virtualCurrency->update(['expiry_date' => now()->addDays(30)]);
        // Update user's verification status here
        return redirect()->back()->with('success', 'Verification mark purchased successfully.');
    }
     else {
        return redirect()->back()->with('error', 'Insufficient virtual currency balance.');
    }
}

    

    
}
