<div class="modal fade" id="delete-product-{{ $product->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <h5 class="modal-title text-danger">
          <i class="fa-solid fa-circle-exclamation"></i> Delete Product
        </h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this product?</p>
        <div class="mt-3 row align-items-center">
          <img src="{{ $product->image }}" alt="{{ $product->name }}" class="col col-3">
          <p class="col-auto fw-bold">{{ $product->name }}</p>
        </div>
      </div>
      <div class="modal-footer border-0">
        <form action="{{ route('product.destroy', $product->id) }}" method="post">
          @csrf
          @method('DELETE')

          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>