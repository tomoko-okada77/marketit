<li class="list-item border-bottom py-3 d-flex align-items-center justify-content-between">
  <div class="w-25 img-square me-4 position-relative overflow-hidden rounded" style="max-width: 100px;">
    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
      @if ($product->transaction)
        <span class="sold sold-sm bg-danger">SOLD</span>
      @endif
      <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover rounded">
    </a>
  </div>
  <div class="w-75 d-flex align-items-center justify-content-between">
    <div>
      <h5 class="text-secondary text-truncate">
        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
      </h5>
      <div class="price">¥<strong class="h5">{{ number_format($product->price, 0, '', ',') }}</strong></div>
    </div>
    {{-- post review --}}
    @if (request()->is('*/purchases'))
      @if (!$product->review)
        <button class="btn btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#post-review-{{ $product->id }}">Post Review</button>
        @include('components.modal.post-review')
      @endif
    @endif
    {{-- remove favorite --}}
    @if (request()->is('*/favorite'))
      @if ($user->id == Auth::user()->id)
        <form action="{{ route('like.destroy', $product->id) }}" method="post" class="d-inline">
          @csrf
          @method('DELETE')

          <button type="submit" class="btn p-0 fs-4">
            <i class="fa-regular fa-trash-can text-danger"></i>
          </button>
        </form>
      @endif
    @endif
    {{-- remove from cart --}}
    @if (request()->is('cart'))
      <form action="{{ route('cart.destroy', $product->id) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn p-0 fs-4">
          <i class="fa-regular fa-trash-can text-danger"></i>
        </button>
      </form>
    @endif
  </div>
</li>