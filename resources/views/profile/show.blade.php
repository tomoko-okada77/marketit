@extends('layouts.app')

@section('title', 'profile')

@section('content')
  <div class="col-md-8 col-sm-12">
    @include('components.profile-header')
    <ul class="row list-unstyled pt-4 border-top">
      @forelse ($user->products as $product)
        @include('components.product-grid')
      @empty
        <li>No products yet.</li>
      @endforelse
    </ul>
  </div>
@endsection