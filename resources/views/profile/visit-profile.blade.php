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
      <button type="submit" class="btn btn-primary text-dark">Purchase Verification Mark</button>
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
      <div class="flex flex-col gap-2 w-60 sm:w-72 text-[10px] sm:text-xs z-50 notification-panel" style="display: none;">
        <div class="succsess-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-[#232531] px-[10px]">
          <div class="flex gap-2">
            <div class="text-[#2b9875] bg-white/5 backdrop-blur-xl p-1 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
              </svg>
            </div>
            <div>
              <p class="text-white">done successfully :)</p>
              <p class="text-gray-500">This is the description section</p>
            </div>
          </div>
          <button class="text-gray-600 text-gray-600 hover:bg-white/5 p-1 rounded-md transition-colors ease-linear">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
            </svg>
          </button>
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
                      <label>

                        <input class="flex w-full rounded-md border border-blue-300 border-input bg-white text-sm text-gray-400 file:border-0 file:bg-blue-600 file:text-white file:text-sm file:font-medium" type="file" id="picture" name="image" />


                      </label>
                      <button type="submit" class="bg-green-950 text-green-400 border border-green-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
                        <span class="bg-green-400 shadow-green-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
                        Upload Image
                      </button>
                    </li>

                  </ul>

                </form>
                @endif
              </div>
            </div>
          </div>
          <div class="container mx-auto mt-10">
            <!-- edit and ceate links -->
            <div class="card mb-4 mb-lg-0">
              @if(auth()->user()->id == $user->id)
              @if ($socialLinks == null)
              <a href="/social-links/create"><button class="bg-green-950 text-green-400 border border-green-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
                  <span class="bg-green-400 shadow-green-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
                  Create Social links
                </button></a>

              @else
              <a href="/social-links/{{$socialLinks->id}}"><button class="bg-green-950 text-green-400 border border-green-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
                  <span class="bg-green-400 shadow-green-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
                  Edit Social links

                </button></a>

              @endif
              @endif
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
        <div class="col-lg-8 group cursor-pointer group-hover:duration-500 overflow-hidden relative  rounded-2xl shadow-inner shadow-gray-50 flex flex-col justify-around items-center w-90 h-100 bg-neutral-900 text-gray-50" style="background-color:rgb(12 68 61);">
          <section id="resume" class="resume section py-8">
            <div class="container mx-auto section-title">
              @if (auth()->user()->id == $user->id)
                
              
              @if ($user->additionalInfo == '')
              <a href="{{ route('resume.create') }}">
                <button class="bg-green-950 text-green-400 border border-green-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
                  <span class="bg-green-400 shadow-green-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
                  Create Resume
                </button>
              </a>
              @else
              <a href="{{ route('resume.edit', ['user' => $user->id]) }}">
                <button class="bg-green-950 text-green-400 border border-green-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
                  <span class="bg-green-400 shadow-green-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
                  Update Resume
                </button>
              </a>
              @endif
              @endif


              <h2 class="text-4xl font-bold text-center">Resume</h2>
              <p class="text-center text-lg mt-4">{{ $user->additionalInfo->summary ?? 'Not provided' }}</p>
            </div>

            <div class="container mx-auto mt-8">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                  <h3 class="resume-title text-2xl font-semibold mb-4">Summary</h3>
                  <div class="resume-item pb-0 bg-white p-4 rounded-lg shadow-lg">
                    <h4 class="text-xl text-dark">{{ $user->name }}</h4>
                    <p class="text-black-600"><em>{{ $user->additionalInfo->summary ?? 'Not provided' }}</em></p>
                    <ul class="mt-4">
                      <li class="mb-2">{{ $user->address }}</li>
                      <li class="mb-2">{{ $user->phone }}</li>
                      <li>{{ $user->email }}</li>
                    </ul>
                  </div>

                  <h3 class="resume-title text-2xl font-semibold mt-8 mb-4">Education</h3>
                  @foreach ($user->educations as $education)
                  <div class="resume-item bg-white p-4 rounded-lg shadow-lg mb-4">
                    <h4 class="text-xl  text-dark">{{ $education->degree }}</h4>
                    <h5 class="text-gray-600">{{ $education->year }}</h5>
                    <p><em>{{ $education->institution }}</em></p>
                    <p>{{ $education->description }}</p>
                  </div>
                  @endforeach
                </div>

                <div>
                  <h3 class="resume-title text-2xl font-semibold mb-4">Professional Experience</h3>
                  @foreach ($user->experiences as $experience)
                  <div class="resume-item bg-white p-4 rounded-lg shadow-lg mb-4">
                    <h4 class="text-xl text-dark">{{ $experience->title }}</h4>
                    <h5 class="text-gray-600">{{ $experience->duration }}</h5>
                    <p><em>{{ $experience->company }}</em></p>
                    <p>{{ $experience->description }}</p>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </section>

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
          //console.log(response); // Log the response from the server
          if (response.success) {
            // Show the notification panel
            $('.notification-panel').css('display', 'block');
            setTimeout(function() {
              $('.notification-panel').css('display', 'none');
            }, 3000)
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>