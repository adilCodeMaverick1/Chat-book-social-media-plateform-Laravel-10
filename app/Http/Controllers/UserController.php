<?php

namespace App\Http\Controllers;

use App\Models\User;
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


}
