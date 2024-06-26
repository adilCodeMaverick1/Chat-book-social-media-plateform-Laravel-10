
<x-app-layout>
@if ($users->isEmpty())
        <div class="alert alert-warning text-center m-5" role="alert">
            No users found.
        </div>
    @else
    
@foreach ($users as $user)
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex text-black">
              <div class="flex-shrink-0">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                  alt="Generic placeholder image" class="img-fluid"
                  style="width: 180px; border-radius: 10px;">
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">
    <div>{{ $user->name }}</div>

</h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Journalist</p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
           
                  <div>
                    <p class="small text-muted mb-1">Posts</p>
                    <p class="mb-0"> {{ $postCount[$user->id] }}</p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">Followers</p>
                    <p class="mb-0"> {{ $followersCount[$user->id] }}</p>
                  </div>
                  <div>
                    <p class="small text-muted mb-1">Following</p>
                    <p class="mb-0">{{ $followingCount[$user->id] }}</p>
                  </div>
           
                </div>
                <div class="d-flex pt-1">
                  <button type="button" class="btn btn-outline-primary me-1 flex-grow-1 m-2">Chat</button>
                  <button type="button" class="btn btn-outline-primary flex-grow-1 m-2">Follow</button>
                  
                <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-outline-primary flex-grow-1 m-2">View Profile</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endif
  </x-app-layout>
