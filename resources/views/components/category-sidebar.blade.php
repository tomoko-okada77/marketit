<h4 class="fw-bold pb-3">Filter by Category</h4>
<ul class="list-unstyled border-top">
  {{-- <li>
    
  </li> --}}
  @foreach ($all_categories as $category)
    <li>
      <a href="{{ route('category', $category->id) }}" class="{{ request()->is('category/' . $category->id) ? 'bg-light' : '' }} text-decoration-none text-dark border-bottom py-3 px-2 d-flex align-items-center justify-content-between">
        {{ $category->name }}
        <i class="fa-solid fa-chevron-right"></i>
      </a>
    </li>
  @endforeach
  <li>
    <a href="{{ route('all') }}" class="text-decoration-none text-dark border-bottom py-3 px-2 d-flex align-items-center justify-content-between">
      View All Products
      <i class="fa-solid fa-chevron-right"></i>
    </a>
  </li>
</ul>
