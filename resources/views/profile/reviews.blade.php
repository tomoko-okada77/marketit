@extends('layouts.app')

@section('title', 'reviews')

@section('content')
  <div class="col-md-7 col-sm-12 mx-auto">
    <h2 class="mb-4 text-center">Reviews</h2>
    @foreach ($user->reviews as $review)
      <div class="d-flex items-center py-4">
        <div class="avatar avatar-md me-4">
          @include('components.user-avatar', ['user' => $review->reviewer])
        </div>
        <div class="bg-light p-2 rounded flex-grow-1">
          <p class="mb-0">{{ $review->comment }}</p>
          <small class="text-secondary">{{ date('Y/m/d', strtotime($review->created_at)) }}</small>
        </div>
        
      </div>
    @endforeach
  </div>
@endsection