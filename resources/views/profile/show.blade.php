@extends('layouts.app')

@section('title', 'profile')

@section('content')
  <div class="col-md-8 col-sm-12">
    @include('components.profile-header')
    <ul class="row list-unstyled pt-4 border-top">
      @forelse ($user->products as $product)
        @include('components.product-grid')

        {{-- <li class="list-item col-md-3 col-4 mb-3">
          <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
            <div class="img-square position-relative">
              @if ($product->transaction)
                <span class="sold bg-danger">SOLD</span>
              @endif
              <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover rounded">
              <span class="price position-absolute">¥<strong class="h5">{{ number_format($product->price, 0, '', ',') }}</strong></span>
            </div>
            <h5 class="mt-2 text-secondary text-truncate">{{ $product->name }}</h5>
          </a>
        </li> --}}
      @empty
        <li>No products yet.</li>
      @endforelse
    </ul>
  </div>
@endsection