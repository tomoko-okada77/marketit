@extends('layouts.app')

@section('title', 'Following')

@section('content')
  @include('components.btn-back')

  <div class="row  flex-row-reverse">
    <div class="col-md-7 col-sm-12">
      <h2 class="mb-3 text-center">Following</h2>
      @if ($user->following->isNotEmpty())
        <ul class="list-unstyled mx-auto col-10 border-top">
          @foreach ($user->following as $following)
            @include('components.user-list', ['user' => $following->following])
          @endforeach
        </ul>
      @else
        <p class="text-center">No Following Yet.</p>
      @endif
    
      @if ($user->id == Auth::user()->id && $suggested_users)
        <h2 class="mt-5 mb-3 text-center">Suggested Users</h2>
        <ul class="list-unstyled mx-auto col-10 border-top">
          @foreach ($suggested_users as $user)
            @include('components.user-list')
          @endforeach
        </ul>
      @endif
    </div>
    <div class="col-md-5 col-sm-12 mt-md-0 mt-sm-5 mt-5">
      @include('components.profile-sidebar')
    </div>
  </div>
@endsection