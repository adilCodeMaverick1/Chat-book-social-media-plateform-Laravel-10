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
                    <li><a href="/newsfeed" title="">latest</a></li>

                </ul>
            </li>



        </ul>
        <ul class="setting-areaa">

            <li><a href="/newsfeed" title="Home"><i class="fa-solid fa-bell" style="font-size: 25px;"></i></a></li>

            <li>
                <a href="{{ route('chatify') }}" title="Messages">
                    <i class="fa fa-comment" style="font-size: 25px;"></i>
                    <span class="unread badge bg-danger rounded-pill text-white">{{ auth()->user()->getMessageCount() }}</span>
                </a>

            </li>

      
            <li><a href="{{ route('profile.show') }}" title="My Profile"><i class="fa fa-user" style="font-size: 25px;"></i></a>
             
            </li>
        </ul>
        <div class="user-img">

            @if(auth()->user()->image != null)
            <img src="{{ asset(auth()->user()->image) }}" width="30px" height="10px">
            @else
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" width="30px">
            @endif


            <span class="status f-online"></span>
            <div class="user-setting">



            </div>
        </div>
        <span class="fa-solid fa-bars main-menu" data-ripple=""></span>
    </div>
</div><!-- topbar -->
<div class="side-panel">
    <h4 class="panel-title">General Setting</h4>
    <form method="post">
        <div class="setting-row">
            <span>use night mode</span>
            <input type="checkbox" id="nightmode1" />
            <label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
        </div>

    </form>
</div><!-- side panel -->