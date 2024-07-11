<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
//    public function search(Request $request )
// {
//     $query = $request->input('query');
//      //$users = User::where('name', 'LIKE', "%$query%")->get();
//      $users = User::where('name', 'like', '%'.$query.'%')->get();

//      $followersCount = Follower::where('following_id')->count();
//    // $users = User::whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$query])->get();


//     return view('profile.searched-profile', ['users' => $users], ['followersCount' => $followersCount]);
// }
public function search(Request $request)
{
    $query = $request->input('query');
    $request->validate([
        'query' => 'required|string|min:1', // Ensure 'query' is required and at least 1 character long
    ]);

    // Example search logic - you should adjust this based on your actual search requirements
    $users = User::where('name', 'like', '%' . $query . '%')->get();

    $followersCount = [];
    $followingCount = [];
    $postCount = [];
    foreach ($users as $user) {
        $followersCount[$user->id] = Follower::where('following_id', $user->id)->count();
        $followingCount[$user->id] = Follower::where('follower_id', $user->id)->count();
        $postCount[$user->id] = Post::where('user_id', $user->id)->count();
    }

    return view('profile.searched-profile', compact('users', 'followersCount','followingCount', 'postCount'));
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
//upload image
public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
$user=  new User();
    // Get the authenticated user
    $user = auth()->user();

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);
        $user->image = 'storage/images/' . $imageName; // Store the image path in the user's image column
    }

    // Save the user to update the image
    if ($user->save()) {
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to upload image.');
    }
}


}
