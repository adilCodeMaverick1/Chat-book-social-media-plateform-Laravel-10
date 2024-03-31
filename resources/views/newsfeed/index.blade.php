<?php

use App\Models\Post;

$posts = Post::get();

?>

<x-app-layout>

    <div class="container d-flex justify-content-center align-items-center ">
        <div class="col-lg-2 widget sidebar mt-2 sidebar-1">
            <ul class="naves">
                <li>
                    <i class="fas fa-newspaper"></i>
                    <a href="/newsfeed" title="">News feed</a>
                </li>
                <li>
                    <i class="fas fa-inbox"></i>
                    <a href="inbox.html" title="">Inbox</a>
                </li>
                <li>
                    <i class="fas fa-file"></i>
                    <a href="fav-page.html" title="">My pages</a>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <a href="timeline-friends.html" title="">friends</a>
                </li>
                <li>
                    <i class="fas fa-images"></i>
                    <a href="timeline-photos.html" title="">images</a>
                </li>
                <li>
                    <i class="fas fa-video"></i>
                    <a href="timeline-videos.html" title="">videos</a>
                </li>
                <li>
                    <i class="fas fa-comments"></i>
                    <a href="messages.html" title="">Messages</a>
                </li>

            </ul>
        </div>
        <div class=" central-meta col-lg-6 ">
            <div class="new-postbox col-md-12">
                <figure>
                    <img src="images/resources/admin2.jpg" alt="">
                </figure>
                <div class="">
                    <form id="postForm" enctype="multipart/form-data">



                        @csrf
                        <div class="container">
    <div class="row align-items-center">
        <div class="col-auto">
            @if(auth()->user()->image != null)
                <img src="{{ asset(auth()->user()->image) }}" width="30" class="rounded-circle">
            @else
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" width="30" class="rounded-circle">
            @endif
        </div>
        <div class="col">
            <input type="text" name="content" rows="2" class="form-control rounded-4" placeholder="Write something">
        </div>
    </div>
</div>

                        <div class="attachments">
                            <ul>
                                <li>
                                    <i class="fa fa-image fa-lg"></i>
                                    <label class="fileContainer">
                                        <input type="file" name="image">
                                    </label>
                                </li>
                                <li>
                                    <button type="submit" class="btn btn-outline-primary mt-1">Post</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 pack">Discover Our AI Proffesional Pics Pack starting from just 5$/Month
            <a href="" class="btn btn-outline-success">Purchase Now</a>
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
            <!-- Debugging -->

            <!-- Simplified condition -->


            <div class="col-md-3">
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center">
                            @if($post->user->image == null)
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" width="30" class="rounded-circle">
                            @else
                            <img src="{{$post->user->image}}" width="30" class="rounded-circle">
                            @endif
                            <div class="d-flex flex-column ml-2">
                                <span class="font-weight-bold"><a href="{{ route('user.profile', ['id' => $post->user_id]) }}">{{$post->user->name}}</a></span>
                                <small class="text-primary">Colleagues</small>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis">
                            <small class="mr-2">{{$post->created_at->diffForHumans()}}</small>
                            @if(auth()->id() == $post->user_id)
                            <button type="button" class="fa fa-trash text-danger delete-post-btn" data-post-id="{{ $post->id }}"></button>
                            @else
                            <button type="button" class="fa fa-warning text-danger report-post-btn" data-post-id="{{ $post->id }}"></button>
                            @endif
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
                                <textarea name="content" rows="2" class="form-control" placeholder="write comment...."></textarea>
                                <button type="submit" class="btn btn-outline-primary mt-1"> Comment</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
           
            @endforeach
        </div>
    </div>




</x-app-layout>
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
                        window.location.href = '/newsfeed';

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

    //without page load
    // Example using jQuery<script>
    $(document).ready(function() {
        $('#travelButton').click(function() {
            $.ajax({
                url: '{{ route("travel") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update the result div with the response data
                    $('#result').html(response.data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>



</script>