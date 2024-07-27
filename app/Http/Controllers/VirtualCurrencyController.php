<?php

namespace App\Http\Controllers;
use App\Models\VirtualCurrency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\UserTheme;

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
public function purchaseTheme(Request $request)
    {
        $user = auth()->user();
        $theme = Theme::findOrFail($request->theme_id);
        $themeCost = $theme->cost;

        if ($user->virtualCurrency->balance >= $themeCost) {
            $user->virtualCurrency->decrement('balance', $themeCost);
            UserTheme::create(['user_id' => $user->id, 'theme_id' => $theme->id]);
            return redirect()->back()->with('success', 'Theme purchased successfully.');
        } else {
            return redirect()->back()->with('error', 'Insufficient virtual currency balance.');
        }
    }
    

    
}
