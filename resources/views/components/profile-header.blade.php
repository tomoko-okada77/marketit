<div class="row pb-4 align-items-center">
  <div class="col-auto">
    <div class="avatar avatar-xl">
      @include('components.user-avatar')
    </div>
  </div>
  <div class="col-auto">
    <div class="d-flex justify-content-between mt-3">
      <div class="me-4"><h2>{{ $user->name }}</h2></div>
      <div class="d-flex align-items-center">
        @if (Auth::user()->id == $user->id)
          <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-outline-secondary">Edit Profile</a>
        @else
          @if ($user->isFollowed())
            <form action="{{ route('follow.destroy', $user->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-secondary">Unfollow</button>
            </form>
          @else
            <form action="{{ route('follow.store', $user->id) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-secondary">Follow</button>
            </form>
          @endif  
        @endif
      </div>
    </div>

    <div>
      @include('components.profile-score')
    </div>
    
    @if ($user->introduction)
      <p class="text-muted">{{ $user->introduction }}</p>
    @else
      <p class="text-muted">No introduction yet.</p>
    @endif

    <div class="mt-2">
      <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->products->count() }} Products</a> &nbsp;&nbsp; 
      <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark"> {{ $user->followers->count() }} Follower</a> &nbsp;&nbsp; 
      <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">{{ $user->following->count() }} Following</a>
    </div>
  </div>
</div>