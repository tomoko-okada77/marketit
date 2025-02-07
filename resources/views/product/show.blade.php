@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row gx-md-5">
  <div class="col-md-6 col-sm-12">
    <div class="position-relative overflow-hidden">
      <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100">
      @if ($product->transaction)
        <span class="sold sold-lg bg-danger">SOLD</span>
      @endif
    </div>
    <div class="mt-3">
      @if ($product->isLiked())
        <form action="{{ route('like.destroy', $product->id) }}" method="post" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn p-0 fs-4" title="Unfavorite">
            <i class="fa-solid fa-heart text-danger me-1 fs-4"></i>
          </button>
        </form>
        {{-- <form action="{{ route('like.destroy', $product->id) }}" method="post" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn p-0 fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="Unfavorite">
            <i class="fa-solid fa-heart text-danger me-1 fs-4"></i>
          </button>
        </form> --}}
      @else
        <form action="{{ route('like.store', $product->id) }}" method="post" class="d-inline">
          @csrf
          <button type="submit" class="btn p-0 fs-4" title="Add to favorites">
            <i class="fa-regular fa-heart text-secondary me-1 fs-4"></i>
          </button>
        </form>
        {{-- <form action="{{ route('like.store', $product->id) }}" method="post" class="d-inline">
          @csrf
          <button type="submit" class="btn p-0 fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="Add to favorites">
            <i class="fa-regular fa-heart text-secondary me-1 fs-4"></i>
          </button>
        </form> --}}
      @endif
      {{ $product->likes->count() }}
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
    <h3 class="text-black">{{ $product->name }}</h3>
    <div class="price">
      ¥<strong class="h4">{{ number_format($product->price, 0, '', ',') }}</strong>
    </div>
    <div class="my-4">
      @foreach ($product->productCategories as $product_category)
        <span class="border rounded me-1 p-2">
          <a href="{{ route('category', $product_category->category->id) }}" class="text-decoration-none text-dark">{{ $product_category->category->name }}</a>
        </span>
      @endforeach
    </div>
    <div>
    </div>
    @if (Auth::user()->id == $product->user->id && !$product->transaction)
      <div class="btn-group mb-4">
        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning px-5 me-1 rounded">Edit</a>
        <button class="btn btn-outline-danger rounded" data-bs-toggle="modal" data-bs-target="#delete-product-{{ $product->id }}">
          Delete
        </button>
      </div>
      @include('components.modal.delete-product')
    @else
      <div class="mb-4 d-flex">
        @if ($product->transaction)
          <div class="col-5">
            <button disabled class="btn btn-secondary w-100">Sold Out</button>
          </div>
        @else
          <div class="col-5">
            <form action="{{ route('transaction.store', $product->id) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-primary w-100">Buy Now</button>
            </form>
          </div>
          <div class="col-5 ms-1">
            @if ($product->cartItems->where('user_id', Auth::id())->isNotEmpty())
              <a href="{{ route('cart') }}" class="btn btn-outline-primary w-100">View Cart</a>
            @else
              <form action="{{ route('cart.store', $product->id) }}" method="post">
                @csrf 
                <button type="submit" class="btn btn-outline-primary w-100">Add to Cart</button>
              </form>
            @endif
            
          </div>
        @endif
      </div>
    @endif
    <div class="mb-5">
      <h4 class="mb-3 py-2 border-bottom">Item description</h4>
      <p class="my-0 text-secondary pre-line">{{ $product->description }}</p>
    </div>
    <div class="mb-5">
      <h4 class="mb-3 py-2 border-bottom">Seller</h4>
      <div class="d-flex align-items-center">
        <div class="me-2">
          <div class="avatar avatar-md">
            @include('components.user-avatar', ['user' => $product->user])
          </div>
        </div>
        <div class="col-auto"><a href="{{ route('profile.show', $product->user->id) }}" class="text-dark text-decoration-none">{{ $product->user->name }}</a></div>
      </div>
    </div>
    {{-- comments --}}
    @if (!$product->transaction || $product->comments->isNotEmpty())
      <div class="mb-5">
        <h4 class="mb-3 py-2 border-bottom">Comments</h4>
        @if (!$product->transaction)
          <form action="{{ route('comment.store', $product->id) }}" method="POST" class="overflow-hidden">
            @csrf 
            <textarea name="body" rows="3" class="form-control" placeholder="Add a comment">{{ old('body') }}</textarea>
            <div class="float-end">
              <button type="submit" class="mt-2 mb-4 btn btn-primary btn-sm d-inline">
                Send
              </button>
            </div>
            @error('body')
              <div class="text-danger small my-1">{{ $message }}</div>
            @enderror
          </form>
        @endif
        
        @if ($product->comments->isNotEmpty())
          <ul class="list-unstyled">
            @foreach ($product->comments->take(3) as $comment)
                <li>
                  <div class="d-flex align-items-center">
                    <div class="me-2">
                      <div class="avatar avatar-sm">
                        @include('components.user-avatar', ['user' => $comment->user])
                      </div>
                    </div>
                    <div>
                      <a href="{{ route('profile.show', $comment->user->id) }}" class="text-dark text-decoration-none">{{ $comment->user->name }}</a>
                      <small class="text-secondary ms-2">{{ date('Y/m/d', strtotime($comment->created_at)) }}</small>
                    </div>
                  </div>
                  <div class="mt-1 mb-3 d-flex justify-content-between">
                    <p class="mb-0 pt-1 ps-1 flex-grow-1 text-break text-secondary">{{ $comment->body }}</p>
                    @if ($comment->user_id == Auth::user()->id)
                      <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="ms-2">
                        @csrf 
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                      </form>
                    @endif
                  </div>
                </li>
            @endforeach
          </ul>
          @if ($product->comments->count() > 3)
            <div class="mb-3 text-center">
              <button class="btn btn-outline-secondary btn-rounded" data-bs-toggle="modal" data-bs-target="#show-comments-{{ $product->id }}">View all comments</button>
            </div>
            @include('components.modal.comments')
          @endif
        @endif
      </div>
    @endif
    {{-- review --}}
    @if ($product->review)
      <div class="mt-2">
        <h4 class="mb-3 py-2 border-bottom">Review</h4>
        <div class="d-flex align-items-center">
          <div class="avatar avatar-sm me-2">
            @include('components.user-avatar', ['user' => $product->review->reviewer])
          </div>
          <div>{{ $product->review->reviewer->name }}</div>
        </div>
        <p class="mt-2 text-secondary">{{ $product->review->comment }}</p>
      </div>  
    @endif
  </div>
</div>
<script> document.addEventListener("DOMContentLoaded", function() { const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]'); tooltipTriggerList.forEach(tooltipTriggerEl => { new bootstrap.Tooltip(tooltipTriggerEl); }); }); </script>
@endsection