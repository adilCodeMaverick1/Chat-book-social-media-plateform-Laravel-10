<div class="responsive-header">
    <div class="mh-head first Sticky">
        <span class="mh-btns-left">
            <a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
        </span>
        <span class="mh-text">
            <a href="newsfeed.html" title=""><img src="images/logo2.png" alt=""></a>
        </span>
        <span class="mh-btns-right">
            <a class="fa fa-sliders" href="#shoppingbag"></a>
        </span>
    </div>
    <div class="mh-head second">
        <form class="mh-form">
            <input placeholder="search" />
            <a href="#/" class="fa-solid fa-magnifying-glass"></a>
        </form>
    </div>
    <nav id="menu" class="res-menu">
        <ul>
            <li><span>Home</span>
                <ul>
                    <li><a href="index-2.html" title="">Home Social</a></li>

                </ul>
            </li>
        </ul>
    </nav>
    <nav id="shoppingbag">
        <div>
            <div class="">
                <form method="post">
                    <div class="setting-row">
                        <span>Show profile</span>
                        <input type="checkbox" id="switch5" />
                        <label for="switch5" data-on-label="ON" data-off-label="OFF"></label>
                    </div>
                </form>
                <h4 class="panel-title">Account Setting</h4>
                <form method="post">
                    <div class="setting-row">
                        <span>Sub users</span>
                        <input type="checkbox" id="switch6" />
                        <label for="switch6" data-on-label="ON" data-off-label="OFF"></label>
                    </div>


                </form>
            </div>
            
        </div>
    </nav>
</div><!-- responsive header -->

<div class="topbar stick">
    <div class="logo">
        <a title="" href="newsfeed.html"><img src="images/logo.png" alt=""></a>
    </div>

    <div class="top-area">
        <ul class="main-menu">
            <li>
                <a href="/newsfeed" title="newsfeed" class="fa fa-newspaper" style="font-size: 30px;"></a>
                <ul>
                    <li><a href="/chatify" title="">latest</a></li>

                </ul>
            </li>
            <li>
                <form action="{{ route('search') }}" method="GET">
                    <input id="search" type="search" name="query" placeholder="Search users..." class="rounded-4 p-2" style="width: 300px;">
                    <button type="submit" class="btn btn-outline-dark ">find</button>
                    @error('query')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </form>
            </li>



        </ul>
        <ul>
            <li><a href="/user/{{auth()->user()->id}}" title="My Profile"><i class="fa fa-user" style="font-size: 25px;"></i></a>

        </ul>
        <ul class="setting-area">




            <li>
                <i class="fa fa-bell " data-ripple="" style="font-size: 25px;"></i>
                <span class=" badge bg-danger rounded-pill text-white bellcount">{{ $notifications->count() }}</span>
                <div class="dropdowns">
                    <span>{{ $notifications->count() }} New Notifications</span>
                    <ul class="drops-menu ">
                        @foreach ( $notifications->sortByDesc('created_at')->take(3) as $post)

                        <li>
                            <a href="notifications.html" title="">
                                @if ($post->image != null)
                                <img src="{{$post->image}}" alt="">
                                @else
                                <!-- Display a placeholder image or no image -->
                                <img src="placeholder.jpg" alt="No Image">
                                @endif

                                <div class="mesg-meta">
                                    <h6>{{$post->name}}</h6>
                                    <span>liked your post</span>

                                    <i>{{$post->content}}</i>
                                    <i>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</i>
                                </div>
                            </a>
                            <span class="tag green">New</span>
                        </li>
                        @endforeach





                    </ul>
                    <a href="notifications.html" title="" class="more-mesg">view more</a>
                </div>
            </li>
            <li>
              
                <i class="fa fa-comment " data-ripple="" style="font-size: 25px;"></i>
                <span class="badge bg-danger rounded-pill text-white bellcount">{{ auth()->user()->getMessageCount() }}</span>

                <div class="dropdowns">
                    <span>{{ auth()->user()->getMessageCount() }}New Messages</span>
                    <ul class="drops-menu">
                        @foreach ( $messages->sortByDesc('created_at')->take(5) as $message)
                        <li>
                            <a href="notifications.html" title="">
                                <img src="{{$message->user->image}}" alt="">
                                <div class="mesg-meta">
                                    <h6>{{$message->user->name}}</h6>
                                    <span>{{$message->body}}</span>
                                    <i>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</i>
                                </div>
                            </a>
                            <span class="tag green">New</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>


            </li>


            </li>
        </ul>
        <div class="user-img">

       
          
          
        <span class="fa-solid fa-bars main-menu" data-ripple=""></span>
           


            
          
        </div>
        
    </div>
</div><!-- topbar -->
<div class="side-panel">
    <h4 class="panel-title">General Setting</h4>
    <form method="post" id="profileForm">
        <div class="setting-row">
            <span>Private profile </span>
            <input type="checkbox" id="privateProfileSwitch" {{ auth()->user()->private == 1 ? 'checked' : '' }} />
            <label for="privateProfileSwitch" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <input type="hidden" id="userId" value="{{ auth()->user()->id }}">
    </form>

    <script>
        $(document).ready(function() {
            $('#privateProfileSwitch').change(function() {
                var isPrivate = this.checked ? 1 : 0;
                var userId = $('#userId').val();
                var token = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token from meta tag

                $.ajax({
                    url: '/update-profile',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token // Include CSRF token in headers
                    },
                    data: {
                        _token: token, // Include CSRF token in form data
                        userId: userId,
                        isPrivate: isPrivate
                    },
                    success: function(response) {
                        console.log('Profile updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating profile:', error);
                    }
                });
            });
        });
    </script>







</div><!-- side panel -->