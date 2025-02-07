<div class="modal fade" id="show-comments-{{ $product->id }}">
  <div class="modal-dialog">
    <div class="modal-content border">
      <div class="modal-header border justify-content-center">
        <h3 class="modal-title">
          All comments on this Product
        </h3>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
          @foreach ($product->comments as $comment)
            <li class="pt-3 pb-2 border-bottom">
              <div class="d-flex">
                <div class="avatar avatar-sm me-2">
                  @include('components.user-avatar', ['user' => $product->user])
                </div>
                <div>{{ $product->user->name }}</div>
              </div>
              <div class="mt-1 mb-3 d-flex justify-content-between">
                <p class="mb-0 pt-1 flex-grow-1 text-break pre-line">{{ $comment->body }}</p>
                @if ($comment->user_id == Auth::user()->id)
                  <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="ms-2">
                    @csrf 
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                @endif
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>