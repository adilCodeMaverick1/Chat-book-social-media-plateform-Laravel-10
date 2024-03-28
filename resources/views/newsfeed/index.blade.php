<?php

use App\Models\Post;

$posts = Post::get();
?>

<x-app-layout>
    <div class="container-fluid col-lg-6 d-flex justify-content-center align-items-center mt-5">
        <div class=" central-meta">
            <div class="new-postbox">
                <figure>
                    <img src="images/resources/admin2.jpg" alt="">
                </figure>
                <div class="newpst-input">
                    <form id="postForm" enctype="multipart/form-data">

                        @csrf
                        <textarea name="content" rows="2" class="form-control" placeholder="write something"></textarea>
                        <div class="attachments">
                            <ul>
                                <li>
                                    <i class="fa fa-image"></i>
                                    <label class="fileContainer">
                                        <input type="file" name="image">
                                    </label>
                                </li>
                                <li>
                                    <button type="submit" class="btn btn-primary mt-1">Post</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- add post new box  end-->
    <div class="notification-panel">
        Post successfull!
    </div>
    <div class="notification-comment">
        Comment Posted!
    </div>
    <!-- posts loop -->

    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            @foreach($posts as $post)
            <div class="col-md-3">
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center">
                            <img src="https://i.imgur.com/UXdKE3o.jpg" width="50" class="rounded-circle">
                            <div class="d-flex flex-column ml-2">
                                <span class="font-weight-bold">{{$post->user->name}}</span>
                                <small class="text-primary">Colleagues</small>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis">
                            <small class="mr-2">{{$post->created_at->diffForHumans()}}</small>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#postModal">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                        </div>

                    </div>
                    @if ($post->image != null)
                    <img src="{{$post->image}}" class="img-fluid" alt="Responsive image">
                    @endif
                    <div class="p-2">
                        <p class="text-justify">{{$post->content}}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Like button -->
                            <div class="d-flex flex-row icons d-flex align-items-center">
                                <!-- <i class="fa fa-heart like-button fa-lg" data-post-id="{{ $post->id }}">{{$post->likes}}</i>  -->
                                <i class="fa fa-heart like-button fa-lg {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'liked' : '' }}" data-post-id="{{ $post->id }}">{{$post->likes}}</i>
                            </div>
                            <div class="d-flex flex-row muted-color">
                                <span>{{ $post->comments()->count() }} comments</span>
                                <span class="ml-2">Share</span>
                            </div>
                        </div>
                        <hr>
                        <div class="comments">
                            <!-- Comments Section -->
                        </div>
                        <div class="comment-input">
                            <form class="commentForm" data-post-id="{{ $post->id }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea name="content" rows="2" class="form-control" placeholder="Add a comment"></textarea>
                                <button type="submit" class="btn btn-primary mt-1"> Comment</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Post Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your modal content here -->
                    <!-- For example, you can add options like Edit, Delete, etc. -->
                    @if($post->user_id == auth()->id())
                    <ul>
    <li>
        <button type="button" class="fa fa-trash text-danger delete-post-btn" data-post-id="{{ $post->id }}">Delete</button>
    </li>
</ul>


                    @else
                    <ul>
                        <li>Report</li>

                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<style>
    .btn {
        background-color: blue;
    }

    .notification-panel {
        z-index: 1;
        /* Ensure it's higher than other elements */
        position: fixed;

        bottom: 20px;
        right: 20px;
        background-color: #3b5998;
        color: #fff;
        display: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: transform 0.3s ease-in-out;
    }


    .notification-panel.show {
        transform: translateY(0);
    }

    .notification-comment {
        z-index: 1;
        /* Ensure it's higher than other elements */

        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: black;
        color: wheat;
        display: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: transform 0.3s ease-in-out;
    }


    .notification-comment.show {
        transform: translateY(0);
    }

    /* Default color for the heart icon */
    .fa-heart {
        color: black;
        /* Change this to your default color */
    }

    /* Red color for the heart icon when liked */
    .fa-heart.liked {
        color: red;
        /* Change this to your liked color */
    }
</style>

<script>
    //post
    $(document).ready(function() {
        $('#postForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = new FormData(this); // Create a FormData object from the form

            $.ajax({
                url: '{{ route("newsfeed.store") }}',
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    console.log(response); // Log the response from the server
                    if (response.success) {
                        // Show the notification panel
                        $('.notification-panel').css('display', 'block');
                        setTimeout(function() {
                            $('.notification-panel').css('display', 'none');
                        }, 3000); // Hide the panel after 3 seconds
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    //like
    $(document).ready(function() {
        $('.like-button').click(function() {
            var postId = $(this).data('post-id');
            var url = '{{ route("newsfeed.like") }}';

            var likeIcon = $(this);

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    postId: postId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Toggle the color of the like button
                        likeIcon.toggleClass('liked');

                        // Update the like count in the UI
                        var likeCountElement = likeIcon;
                        var currentCount = parseInt(likeCountElement.text());
                        if (likeIcon.hasClass('liked')) {
                            // Increment like count by 1
                            likeCountElement.text(currentCount + 1);
                        } else {
                            // Decrement like count by 1
                            likeCountElement.text(currentCount - 1);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    //comment
    

    $(document).ready(function() {
        $('.commentForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = new FormData(this); // Create a FormData object from the form

            $.ajax({
                url: '{{ route("newsfeed.comment") }}',
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    console.log(response); // Log the response from the server
                    if (response.success) {
                        // Show the notification panel
                        $('.notification-comment').css('display', 'block');
                        setTimeout(function() {
                            $('.notification-comment').css('display', 'none');
                        }, 3000); // Hide the panel after 3 seconds
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Show an error message or handle the error
                }
            });
        });
    });
    //delete
    $(document).ready(function() {
    $('.delete-post-btn').click(function() {
        var postId = $(this).data('post-id');
        var url = '/newsfeed/delete/' + postId;

        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
            alert('Post deleted successfully');    // Post deleted successfully
                    // You can remove the post from the UI here
                } else {
                    // Show an error message or handle the error
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});


</script>