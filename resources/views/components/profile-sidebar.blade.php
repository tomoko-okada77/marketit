<div class="border rounded p-4">
  <div class="mb-3">
    <div class="avatar avatar-lg">
      @include('components.user-avatar')
    </div>
  </div>
  <div class="d-flex justify-content-between">
    <div class="me-4"><h4>{{ $user->name }}</h4></div>
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

@if ($user->id == Auth::user()->id)
  <a href="{{ route('profile.edit', Auth::user()->id) }}" class="px-2 py-4 border-bottom d-flex align-items-center justify-content-between text-decoration-none text-dark">
    Edit Profile
    <i class="fa-solid fa-chevron-right"></i>
  </a>
  <a href="{{ route('profile.favorite', Auth::user()->id) }}" class="px-2 py-4 border-bottom d-flex align-items-center justify-content-between text-decoration-none text-dark">
    My Favorites
    <i class="fa-solid fa-chevron-right"></i>
  </a>
  <a href="{{ route('profile.purchases', Auth::user()->id) }}" class="px-2 py-4 border-bottom d-flex align-items-center justify-content-between text-decoration-none text-dark">
    My Purchases
    <i class="fa-solid fa-chevron-right"></i>
  </a>
  <a href="{{ route('profile.sales', Auth::user()->id) }}" class="px-2 py-4 border-bottom d-flex align-items-center justify-content-between text-decoration-none text-dark">
    My Sales
    <i class="fa-solid fa-chevron-right"></i>
  </a>
@endif