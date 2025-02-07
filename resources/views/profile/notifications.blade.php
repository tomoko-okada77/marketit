@extends('layouts.app')

@section('title', 'notifications')

@section('content')
  <div class="col-md-9 col-sm-12 mx-auto">
    <h2 class="mb-4 text-center">Notifications</h2>
    @if (Auth::user()->unreadNotifications->count() > 0)
      <form action="{{ route('notification.readAll') }}" method="post" class="overflow-hidden">
        @csrf
        @method('PATCH')

        <button type="submit" class="btn px-0 text-primary float-end">Mark all as read</button>
      </form>
    @endif
    <ul class="list-unstyled border-top">
      @forelse ($notifications as $notification)
        <li class="text-left">
          <form action="{{ route('notification.read', $notification->id) }}" method="post" class="text-dark d-flex align-items-center justify-content-between py-3 border-bottom">
            @csrf
            @method('PATCH')

              <div>
                <h5>{{ $notification->message }}</h5>
                <p class="text-secondary m-0">{{ date('Y/m/d', strtotime($notification->created_at)) }}</p>
              </div>     
              <div class="position-relative">
                @if ($notification->unread)
                  <span class="unread-badge bg-danger"></span>
                @endif
                <button type="submit" class="btn btn-sm p-0">
                  <i class="fa-solid fa-chevron-right"></i>
                </button>
              </div>     
          </form>
        </li>  
      @empty
        <li class="text-center mt-5">No notifications yet</li>
      @endforelse
    </ul>
    {{ $notifications->links() }}
  </div>
@endsection