@extends('layouts.app')

@section('title', 'cart')

@section('content')
  @include('components.btn-back')

  <div class="col-md-9 col-sm-12 mx-auto">
    <h2 class="mb-4 text-center">Cart</h2>
    <ul class="list-unstyled border-top">
      @forelse ($cart_items as $cart_item)
        @include('components.product-list', ['product' => $cart_item->product])
      @empty
        <li class="text-center mt-5">No items yet</li>
      @endforelse
    </ul>
    @if ($cart_items->count()>0)
      <div class="mt-5 text-center">
        <form action="{{ route('cart.buy') }}" method="post">
          @csrf
          <button type="submit" class="btn btn-primary w-50" style="max-width: 280px;">Buy All</button>
        </form>
      </div> 
    @endif
  </div>
@endsection