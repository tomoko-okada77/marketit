@extends('layouts.app')

@section('title', 'search')

@section('content')
  <div class="col-md-9 col-sm-12">
    <h2 class="mb-4">Search for "{{ $search }}"</h2>

    <ul class="row list-unstyled">
      @forelse ($products as $product)
        @include('components.product-grid')
      @empty
        <li>No results match</li>
      @endforelse
    </ul>
  </div>
  
  <div class="col-md-3 col-sm-12 pe-md-5">
    @include('components.category-sidebar')
  </div>
@endsection