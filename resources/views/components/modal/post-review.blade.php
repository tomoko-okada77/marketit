<div class="modal fade" id="post-review-{{ $purchase->product->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-secondary">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-secondary">
          <i class="fa-solid fa-pen"></i> Post Review
        </h5>
      </div>
      <form action="{{ route('review.store', $purchase->product->id) }}" method="post">
        @csrf

        <div class="modal-body">
          <div class="mb-3">
            <input type="number" name="score" id="score" min="0" max="5" class="form-control" placeholder="Score" value="{{ old('score') }}">
            @error('score')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <textarea name="comment" rows="3" class="form-control" placeholder="Write a comment">{{ old('comment') }}</textarea>  
            @error('comment')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer border-0">
          @csrf

          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>