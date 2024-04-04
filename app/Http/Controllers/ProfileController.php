<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = User::find($request->userId);
        $user->private = $request->isPrivate;
        $user->save();
    
        return response()->json(['success' => true]);
    }
}
