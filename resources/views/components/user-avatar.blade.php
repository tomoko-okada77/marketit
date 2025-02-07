@if ($user->avatar)
  <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle d-block w-100">
@else
  <i class="fa-solid fa-user text-white"></i>
@endif