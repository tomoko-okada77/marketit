@extends('layouts.app')

@section('title', 'favorite')

@section('content')
  <div class="row flex-row-reverse justify-content-between">
    <div class="col-md-7 col-sm-12">
      <h2 class="mb-4 text-center">Favorites</h2>
      <ul class="list-unstyled border-top">
        @forelse ($user->favorites as $favorite)
          @include('components.product-list', ['product' => $favorite->product])
        @empty
          <li class="text-center mt-5">No favorites yet</li>
        @endforelse
      </ul>
    </div>
    

    <div class="col-md-5 col-sm-12 mt-md-0 mt-sm-5 mt-5 pe-md-4">
      @include('components.profile-sidebar')
    </div>
  </div>
@endsection