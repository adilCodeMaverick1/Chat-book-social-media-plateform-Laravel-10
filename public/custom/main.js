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
                    alert('Post deleted successfully'); // Post deleted successfully
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