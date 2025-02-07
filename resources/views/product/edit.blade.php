@extends('layouts.app')

@section('title', 'create')

@section('content')
  <div class="col-7 mx-auto">
    <h2 class="mb-4 text-center">Edit Product</h2>
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-3">
        <label for="image" class="form-label fw-bold">Image</label>
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100 mb-2">
        <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
        <div class="form-text" id="image-info">
          The acceptable formats are jpeg, jpg, png and gif only.<br>
          Max file size is 1048kb.
        </div>
        @error('image')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="name" class="form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter item name" value="{{ old('name', $product->name) }}">
        @error('name')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter item description" rows="5">{{ old('description', $product->description) }}</textarea>
        @error('description')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      {{-- categories --}}
      <div class="mb-3">
        <label for="" class="form-label d-block fw-bold">
          Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>
        @foreach ($all_categories as $category)
          <div class="form-check form-check-inline">
            @if (in_array($category->id, $selected_categories))
              <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}" checked>
            @else
              <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}">
            @endif
            <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
          </div>
        @endforeach
        @error('category')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="price" class="form-label  fw-bold">Price</label>
        <div class="input-group">
          <span class="input-group-text">¥</span>
          <input type="number" name="price" id="price" class="form-control" placeholder="Enter item price" value="{{ old('price', $product->price) }}">
        </div>
        @error('price')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-6 mt-4 mx-auto text-center">
        <button type="submit" class="btn btn-warning px-5 w-100">Update</button>
        <a href="{{ route('product.show', $product->id) }}" class="d-block text-dark mt-2 rounded">Cancel</a>
      </div>
    </form>
  </div>
  
@endsection