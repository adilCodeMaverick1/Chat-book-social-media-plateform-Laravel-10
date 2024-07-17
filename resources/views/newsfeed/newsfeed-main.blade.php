@foreach($posts->sortByDesc('created_at') as $post)
<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            @if ($post->user->image == null)
            <figure>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="" >
            </figure>
            @else
            <figure>
                <img src="{{$post->user->image}}" alt="">
            </figure>
            @endif


            <div class="friend-name">
                <ins><a href="{{ route('user.profile', ['id' => $post->user->id]) }}" title="">{{$post->user->name}}</a> 
                @if ($post->user->virtualCurrency->expiry_date && $post->user->virtualCurrency->expiry_date->gt(now()))
                <i class="fa-solid fa-check-circle text-primary" title="Verified"></i>
                @endif
                </ins>
                <span>{{$post->created_at->diffForHumans()}}</span>
                @if(auth()->id() == $post->user_id)
                <button type="button" class="fa fa-trash text-danger delete-post-btn" data-post-id="{{ $post->id }}"></button>
                @else
                <button type="button" class="fa fa-warning text-danger report-post-btn" data-post-id="{{ $post->id }}"></button>
                @endif
            </div>






            <div class="post-meta">
                @if(!empty($post->image))
                <img src="{{ $post->image }}" alt="image">
                @endif



                <div class="we-video-info">
                    <ul>

                        <li>
                            <span class="comment" data-toggle="tooltip" title="Comments">
                                <i class="fa fa-comment"></i>
                                <ins>{{ $post->comments()->count() }}</ins>
                            </span>
                        </li>
                        <li>
                            <div class="d-flex flex-row icons d-flex align-items-center">
                                <!-- <i class="fa fa-heart like-button fa-lg" data-post-id="{{ $post->id }}">{{$post->likes}}</i>  -->
                                <i class="fa fa-heart like-button fa-lg {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'liked' : '' }}" data-post-id="{{ $post->id }}">{{$post->likes}}</i>
                            </div>
                        </li>


                    </ul>
                </div>
                <div class="description">

                    <p>
                        {{$post->content}}
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="coment-area">
            <ul class="we-comet">



                <li class="post-comment">
                    <div class="comet-avatar">
                        @if(auth()->user()->image != null)
                        <img src="{{ asset(auth()->user()->image) }}">
                        @else
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp">
                        @endif
                    </div>
                    <div class="post-comt-box">

                        <form class="commentForm" data-post-id="{{ $post->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea name="content" placeholder="Post your comment"></textarea>
                            <div class="add-smiles mt-2">

                                <button type="submit" class="fa-solid fa-arrow-up-long " style="color: black;"> </button>
                            </div>

                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endforeach

<div class="container notification-comment fixed-bottom mb-4 ml-4">
    <div class="alert alert-success alert-dismissible border border-success fade show" role="alert">
        <strong>Success!</strong> Comment posted successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div class="container notification-panel fixed-top mb-4 ml-4">
    <div class="alert alert-success alert-dismissible border border-success fade show" role="alert">
        <strong>Success!</strong>posted successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>





