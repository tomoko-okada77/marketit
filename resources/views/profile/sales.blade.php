@extends('layouts.app')

@section('title', 'My Sales')

@section('content')
  @include('components.btn-back')

  <div class="row flex-row-reverse justify-content-between">
    <div class="col-md-7 col-sm-12">
      <h2 class="mb-4 text-center">My Sales</h2>
      <ul class="list-unstyled border-top">
        @forelse ($user->sales as $sale)
          @include('components.product-list', ['product' => $sale->product])
        @empty
          <li class="text-center mt-5">No sales yet</li>
        @endforelse
      </ul>
    </div>
    

    <div class="col-md-5 col-sm-12 mt-md-0 mt-sm-5 mt-5 pe-md-4">
      @include('components.profile-sidebar')
    </div>
  </div>
@endsection