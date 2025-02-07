@extends('layouts.app')

@section('title', 'home')

@section('content')
  <div class="col-md-9 col-sm-12">
    @if ($recent_products->count())
      <h2 class="mb-4">Recently added</h2>
      <div class="mb-4">
        <ul class="row list-unstyled">
          @foreach ($recent_products as $product)
            @include('components.product-grid')
          @endforeach
        </ul>
      </div>
    @endif

    <h2 class="mb-4">Products on sale</h2>
    <ul class="row list-unstyled">
      @forelse ($home_products as $product)
        @include('components.product-grid')
      @empty
        <li>No products yet</li>
      @endforelse
    </ul>
    {{-- {{ $home_products->links() }} --}}
  </div>
  <div class="col-md-3 col-sm-12 pe-md-5">
    @include('components.category-sidebar')
  </div>
@endsection