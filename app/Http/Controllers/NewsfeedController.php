<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsfeedController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::all(); // Or fetch posts based on user interests


        
        return view('newsfeed.index', ['posts' => $posts]);
    }
    

    


    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Example image validation
        ]);
    
        // Create a new post instance
        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = auth()->id(); // Assuming you're storing the user ID with the post
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $post->image = 'storage/images/' . $imageName; // Store the image path in the database
        }
    
        // Save the post to the database
        if ($post->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['failed' => false]);
        }
    
        // Optionally, you can load all posts and return the view with the updated data
        // $posts = Post::get();
        // return view('newsfeed.index', ['posts' => $posts]);
    }
    public function like(Request $request)
    {
        $postId = $request->input('postId');
        $post = Post::find($postId);
    
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found']);
        }
    
        $user = auth()->user();
    
        // Check if the user has already liked the post
        $existingLike = $post->likes()->where('user_id', $user->id)->first();
    
        if ($existingLike) {
            // If the user already liked the post, remove the like
            $post->likes()->detach($user->id);
            $post->likes -= 1;
        } else {
            // If the user has not liked the post yet, add the like
            $post->likes += 1;
            $post->likes()->attach($user->id);
        }
    
        $post->save();
    
        return response()->json(['success' => true, 'likes' => $post->likes]);
    }
    public function Comment(Request $request)
{
    // Validate the form data
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'content' => 'required|string',
    ]);

    // Create a new comment instance
    $comment = new Comment();
    $comment->post_id = $request->input('post_id');
    $comment->user_id = auth()->id(); // Assuming you're storing the user ID with the comment
    $comment->content = $request->input('content');

    // Save the comment to the database
    if ($comment->save()) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to save comment']);
    }
}
    
//delete post
public function delete(Post $post)
{
    // Check if the user is authorized to delete the post
    if ($post->user_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    // Delete the post
    $post->delete();

    return response()->json(['success' => true]);
}

 //example ajax
 public function travel(Request $request)
{
    $data = Post::all();

    // Return the response
    return view('newsfeed', ['data' => $data]);
}
public function unseenmessage(){

    $unseen = DB::table('ch_messages')->where('to_id', '=', Auth::user()->id)->where('seen',0)->count();
    return response()->json(['unseen' => $unseen]);
}

   
    

}
