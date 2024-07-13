<x-app-layout>



  <!-- <div class="container">
    <h1>Virtual Currency</h1>
    @if(auth()->user()->virtualCurrency)
    <p>Your current balance: {{ auth()->user()->virtualCurrency->balance }}</p>
    @else
    <p>No virtual currency record found for the user.</p>
    @endif

    <form method="POST" action="{{ route('purchase-verification-mark') }}">
      @csrf
      <button type="submit" class="btn btn-primary">Purchase Verification Mark</button>
    </form>
  </div> -->
  @if(auth()->user()->id == $user->id)
  <div class="container">
        <h1>Virtual Currency</h1>
        <p>
    Your current balance:
    <span>{{ auth()->user()->virtualCurrency->balance }}</span>
    <i class="fas fa-coins" style="color: gold;"></i>
</p>

        @if(auth()->user()->virtualCurrency->expiry_date && auth()->user()->virtualCurrency->expiry_date->gt(now()))
            <p>Your verification mark is active.</p>
        @else
            <form method="POST" action="{{ route('purchase-verification-mark') }}">
                @csrf
                <button type="submit" class="btn btn-primary text-dark" >Purchase Verification Mark</button>
            </form>
        @endif
    </div>
    @endif


  <!-- Add more profile details here -->
  <section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="/newsfeed">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('user.profile', ['id' => $user->id]) }}">User</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.profile', ['id' => $user->id]) }}"> Profile</a></li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <!-- Check if the user has uploaded an image -->
              @if($user->image)
              <!-- Show the user's uploaded image -->
              <img src="{{ asset($user->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;margin-left:110px;">
              @else
              <!-- Show a default image if the user has not uploaded one -->
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              @endif

              <h5 class="my-3">
              <h1>
    {{ $user->name }} 
    @if ($user->virtualCurrency->expiry_date && $user->virtualCurrency->expiry_date->gt(now()))
        <i class="fa-solid fa-check-circle text-primary" title="Verified"></i>
    @endif
    
</h1>

</h5>

              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
              <div class="d-flex justify-content-center mb-2">
                @if( Auth::user()->id != $user->id )
                <!-- // Check if the user is authenticated and not viewing their own profile -->
                @if(auth()->check() && auth()->user()->id != $user->id)

                @if(auth()->user()->following()->where('following_id', $user->id)->exists())
                <button type="button" class="btn btn-outline-danger unfollow-btn" data-user-id="{{ $user->id }}">Unfollow</button>
                @else
                <button type="button" class="btn btn-outline-primary follow-btn" data-user-id="{{ $user->id }}">Follow</button>
                @endif


                @endif

                <a href="{{ url('chatify/' . $user->id) }}" type="button" class="btn btn-outline-primary ms-1">Message</a>

                @else
                <form id="postForm" enctype="multipart/form-data">
                  @csrf
                  <ul>
                    <li>
                      <i class="fa fa-image fa-lg"></i>
                      <label class="btn btn-outline-danger btn-sm ">
                        <input type="file" name="image">
                      </label>
                    </li>
                    <li>
                      <button type="submit" class="btn btn-outline-primary mt-1">uploadImage</button>
                    </li>
                  </ul>

                </form>
                @endif
              </div>
            </div>
          </div>
          <div class="container mx-auto mt-10">
        <div class="card mb-4 mb-lg-0">
            <a href="/social-links/create" class="btn btn-primary">Edit links</a>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fas fa-globe fa-lg text-warning"></i>
                        <a class="mb-0" href="{{ $socialLinks->website ?? 'Not provided' }}">{{ $socialLinks->website ?? 'Not provided' }}</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                        <a class="mb-0" href="{{ $socialLinks->github ?? 'Not provided' }}">{{ $socialLinks->github ?? 'Not provided' }}</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                        <a class="mb-0" href="{{ $socialLinks->twitter ?? 'Not provided' }}">{{ $socialLinks->twitter ?? 'Not provided' }}</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                        <a class="mb-0" href="">Instagram not available</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                        <a class="mb-0" href="{{ $socialLinks->facebook ?? 'Not provided' }}">{{ $socialLinks->facebook ?? 'Not provided' }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
        </div>
        @if($user->private == 1 && $user->id != auth()->id())

        <div class="col-lg-8 bg-dark text-light rounded p-5" style="height: 150px;">
          <div class="message">
            <i class="fas fa-lock"></i>
            This Profile is Private
          </div>

        </div>
        @else
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$user->email}}</p>
                </div>
              </div>
              <hr>

              <hr>

              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        @endif

      </div>
    </div>
    
  </section>
</x-app-layout>
<script>
  //follow
  $(document).ready(function() {
    $('.follow-btn').click(function() {
      var following_id = $(this).data('user-id');
      $.ajax({
        url: '/follow',
        method: 'POST',
        data: {
          following_id: following_id
        },
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
          // Handle success response, e.g., update UI
          console.log(response);
          if (method === 'POST') {
            btn.removeClass('follow-btn').addClass('unfollow-btn').text('follow');
          } else {
            btn.removeClass('unfollow-btn').addClass('follow-btn').text('unfollow');
          }
        },
        error: function(xhr, status, error) {
          // Handle error
          console.error(xhr.responseText);
        }
      });
    });
  });
  //unfollow
  $(document).ready(function() {
    $('.follow-btn, .unfollow-btn').click(function() {
      var following_id = $(this).data('user-id');
      var btn = $(this);
      var method = btn.hasClass('follow-btn') ? 'POST' : 'DELETE'; // Determine the HTTP method based on the button class
      $.ajax({
        url: '/follow',
        method: method,
        data: {
          following_id: following_id
        },
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
          // Handle success response, e.g., update UI
          console.log(response);
          if (method === 'POST') {
            btn.removeClass('follow-btn').addClass('unfollow-btn').text('Unfollow');
          } else {
            btn.removeClass('unfollow-btn').addClass('follow-btn').text('Follow');
          }
        },
        error: function(xhr, status, error) {
          // Handle error
          console.error(xhr.responseText);
        }
      });
    });
  });
  //upload image
  $(document).ready(function() {
    $('#postForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      var formData = new FormData(this); // Create a FormData object from the form

      $.ajax({
        url: '{{ route("user.store") }}',
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
</script>