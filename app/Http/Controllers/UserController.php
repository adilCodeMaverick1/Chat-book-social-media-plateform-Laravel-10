<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
   public function search(Request $request)
{
    $query = $request->input('query');
     //$users = User::where('name', 'LIKE', "%$query%")->get();
     $users = User::where('name', 'like', '%'.$query.'%')->get();
   // $users = User::whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$query])->get();


    return view('profile.searched-profile', ['users' => $users]);
}
//visit profile
public function show($id)
{
    $user = User::find($id);
    if (!$user) {
        abort(404); // User not found, return 404 error
    }

    return view('profile.visit-profile', ['user' => $user]);
}
//follow
public function follow(Request $request)
{
    $follower_id = auth()->user()->id;
    $following_id = $request->input('following_id');

    // Check if the user is already following
    if (!Follower::where('follower_id', $follower_id)->where('following_id', $following_id)->exists()) {
        // Save to the followers table
        Follower::create([
            'follower_id' => $follower_id,
            'following_id' => $following_id
        ]);

        return response()->json(['message' => 'Followed successfully']);
    }

    return response()->json(['message' => 'Already following']);
}
//unfollow
public function unfollow(Request $request)
{
    $follower_id = auth()->user()->id;
    $following_id = $request->input('following_id');

    // Remove from the followers table
    Follower::where('follower_id', $follower_id)->where('following_id', $following_id)->delete();

    return response()->json(['message' => 'Unfollowed successfully']);
}

}
