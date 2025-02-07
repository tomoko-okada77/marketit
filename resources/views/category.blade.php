@extends('layouts.app')

@section('title', 'category')

@section('content')
  <div class="col-md-9 col-sm-12">
    <h2 class="mb-4">{{ $category->name }}</h2>
    <ul class="row list-unstyled">
      @if ($category->categoryProducts->isNotEmpty())
        @foreach ($category->categoryProducts as $category_product)
          @include('components.product-grid', ['product' => $category_product->product])
        @endforeach 
      @else
          <li>No products yet.</li>
      @endif
    </ul>
  </div>
  <div class="col-md-3 col-sm-12 pe-md-5">
    @include('components.category-sidebar')
  </div>
@endsection