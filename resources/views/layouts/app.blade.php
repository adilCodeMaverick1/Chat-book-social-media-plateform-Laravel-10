<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/color.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome-free-6.5.2-web/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}" rel="stylesheet">
       <script src="{{asset('jquery/dist/jquery.min.js')}}"></script>
       <script src="{{asset('js/main.min.js')}}"></script>
       <script src="{{asset('js/map-init.js')}}"></script>
       <script src="{{asset('js/script.js')}}"></script>
       <script src="{{asset('js/ajax.js')}}"></script>


        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
       
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            
            @livewire('navigation-menu')
          
           
            

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <audio id="notificationSound">
    <source src="{{ asset('sounds/chatify/new-message-sound.mp3') }}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
        @stack('modals')
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
 var notificationSound = document.getElementById("notificationSound");
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4acf09da40183ef50667', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
$.ajax({
    url: "{{route('unreadcount')}}",
    type: "GET",
    dataType: "json",
    success: function(data) {
        $('.unread').html(data.count);
        notificationSound.play();
    }
})
    });
  </script>
  
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
