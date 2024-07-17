<aside class="sidebar static ">
	<div class="widget">
		<h4 class="widget-title">Shortcuts</h4>
		<ul class="naves">
			<li>
				<i class="fas fa-newspaper"></i>
				<a href="/newsfeed" title="">News feed</a>
			</li>
			<li>
				<i class="fas fa-inbox"></i>
				<a href="/chatify" title="">Inbox</a>
			</li>
			<li>
				<i class="fas fa-file"></i>
				<a href="fav-page.html" title="">My pages</a>
			</li>
			<li>
				<i class="fas fa-users"></i>
				<a href="/user/{{auth()->user()->id}}" title="">followers</a>
			</li>
			<li>
				<i class="fas fa-images"></i>
				<a href="/user/{{auth()->user()->id}}" title="">images</a>
			</li>
			<li>
				<i class="fas fa-video"></i>
				<a href="/user/{{auth()->user()->id}}" title="">videos</a>
			</li>
			<li>
				<i class="fas fa-comments"></i>
				<a href="/chatify" title="">Messages</a>
			</li>

		</ul>
	</div><!-- Shortcuts -->

	<div class="widget stick-widget">
		<h4 class="widget-title">Who's follownig</h4>
		<ul class="followers">
			@foreach ($followers as $follower)
			<li>
				@if ($follower->user->image == null)
				<figure><img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt=""></figure>
				
				@else
				<figure><img src="{{$follower->user->image}}" alt=""></figure>

				@endif
				<div class="friend-meta">
					<h4><a href="/user/{{$follower->user->id}}" title="">{{$follower->user->name}}</a></h4>
				</div>
			</li>
			@endforeach
		</ul>

	</div><!-- who's following -->
</aside>