@extends('layouts.app')

@section('title', 'Followers')

@section('content')
  @include('components.btn-back')

  <div class="row flex-row-reverse">
    <div class="col-md-7 col-sm-12">

      <h2 class="mt-md-0 mt-sm-5 mb-3 text-center">Followers</h2>
    
      @if ($user->followers->isNotEmpty())
        <ul class="list-unstyled mx-auto col-10 border-top">
          @foreach ($user->followers as $follower)
            @include('components.user-list', ['user' => $follower->follower])
          @endforeach
        </ul>
      @else
        <p class="text-center">No Followers Yet.</p>
      @endif
    </div>
    <div class="col-md-5 col-sm-12">
      @include('components.profile-sidebar')
    </div>
  </div>
@endsection