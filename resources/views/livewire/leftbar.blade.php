<aside class="sidebar static">
	<div class="widget">
		<h4 class="widget-title">Shortcuts</h4>
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
	</div><!-- Shortcuts -->

	<div class="widget stick-widget">
		<h4 class="widget-title">Who's follownig</h4>
		<ul class="followers">
			@foreach ($followers as $follower)
			<li>
				<figure><img src="{{$follower->user->image}}" alt=""></figure>
				<div class="friend-meta">
					<h4><a href="time-line.html" title="">{{$follower->user->name}}</a></h4>
				</div>
			</li>
			@endforeach
		</ul>

	</div><!-- who's following -->
</aside>