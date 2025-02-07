<li class="list-item row align-items-center border-bottom py-4">
  <div class="col d-flex align-items-center">
    <div class="col-auto">
      <div class="avatar avatar-md me-2">
        <a href="{{ route('profile.show', $user->id) }}">
          @include('components.user-avatar')
        </a>
      </div>
    </div>
    <div class="col-auto">
      <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
    </div>
  </div>
  <div class="col-auto">
    @if ($user->id != Auth::user()->id)
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
</li>