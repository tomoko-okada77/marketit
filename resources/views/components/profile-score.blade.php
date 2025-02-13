<a href="{{ route('profile.reviews', $user->id) }}" class="text-decoration-none">
  @for ($i = 0; $i < $user->averageScore(); $i++)
    <i class="fa-solid fa-star text-warning"></i>
  @endfor

  @for ($i = $user->averageScore(); $i < 5; $i++)
    <i class="fa-solid fa-star text-secondary"></i>
  @endfor
  
  <span class="ms-1">{{ $user->reviews->count() }} Reviews</span>
</a>