@extends('layouts.app')

@section('title', 'create')

@section('content')
  <div class="col-md-8 col-sm-12 mx-auto">
    <h2 class="mb-4 text-center">Add New Product</h2>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="image" class="form-label fw-bold">Image</label>
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
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter item name" value="{{ old('name') }}">
        @error('name')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter item description" rows="5">{{ old('description') }}</textarea>
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
            <input type="checkbox" name="category[]" id="{{ $category->name }}" class="form-check-input" value="{{ $category->id }}">
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
          <input type="number" name="price" id="price" class="form-control" placeholder="Enter item price" value="{{ old('price') }}">
        </div>
        @error('price')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-6 mt-4 mx-auto text-center">
        <button type="submit" class="btn btn-primary px-5 w-100">Add</button>
      </div>
    </form>
  </div>
  
@endsection