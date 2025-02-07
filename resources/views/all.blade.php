@extends('layouts.app')

@section('title', 'all products')

@section('content')
  <div class="col-md-9 col-sm-12">
    <ul class="row list-unstyled">
      @forelse ($all_products as $product)
        @include('components.product-grid')
      @empty
        <li>No products yet</li>
      @endforelse
    </ul>
    {{ $all_products->links() }}
  </div>
  <div class="col-md-3 col-sm-12 pe-md-5">
    @include('components.category-sidebar')
  </div>
@endsection