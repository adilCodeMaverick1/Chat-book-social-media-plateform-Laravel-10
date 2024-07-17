<x-app-layout>

	<!--<div class="se-pre-con"></div>-->
	<div class="theme-layout">

		@include('livewire.topbar')
		

		<section>
			<div class="gap gray-bg">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="row" id="page-contents">
								<div class="col-lg-3">
									@include('livewire.leftbar')
								</div><!-- sidebar -->
								<div class="col-lg-6">
									<div class="central-meta">
										<div class="new-postbox">
											<figure>
												@if(auth()->user()->image != null)
												<img class="w-10 h-10 rounded" src="{{ asset(auth()->user()->image) }}" alt="Default avatar">
												@else
												<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp">
												@endif
											</figure>
											<div class="newpst-input">
												<form id="postForm" enctype="multipart/form-data">
													@csrf
													<input type="text" name="content" rows="2" class="form-control rounded-4" placeholder="Write something....">
													<div class="attachments">
														<ul>
															
															<li>
																<i class="fa fa-image fa-lg"></i>
																<label class="fileContainer">
																	<input type="file" name="image">
																</label>
															</li>
															<li>
																
																<button type="submit" class="bg-red-950 text-red-400 border border-red-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
  <span class="bg-red-400 shadow-red-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
 Post
</button>
															</li>

														</ul>
													</div>
												</form>
											</div>
										</div>
									</div><!-- add post new box -->
									<div class="loadMore">

										@include('newsfeed.newsfeed-main')

									</div>
								</div><!-- centerl meta -->
								<div class="col-lg-3">
							@include('livewire.aside')
								</div><!-- sidebar -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>



	</div>
	







</x-app-layout>


<script>
	   // Enable pusher logging - don't include this in production

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
						window.location.href = '/newsfeed';
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



