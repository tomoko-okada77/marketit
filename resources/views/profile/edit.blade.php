@extends('layouts.app')

@section('title', 'Edit profile')

@section('content')
  <div class="col-md-7 col-sm-12 mx-auto">
    <h2 class="mb-4 text-center">Edit profile</h2>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="">
      @csrf 
      @method('PATCH')

      <div class="row align-items-center mb-4">
        <div class="col-auto">
          <div class="avatar avatar-lg">
            @include('components.user-avatar')
          </div>
        </div>
        <div class="col-auto">
          <input type="file" name="avatar" class="form-control">
          <div class="form-text">
            The acceptable formats: jpeg, jpg, png, gif only.<br>Max file size is 1048kb.
          </div>
        </div>
        @error('avatar')
          <p class="text-danger small">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" autofocus>
        @error('name')
          <p class="text-danger small">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="email">E-mail Address</label>
        <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        @error('email')
          <p class="text-danger small">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="introduction">Introduction</label>
        <textarea name="introduction" id="introduction" class="form-control">{{ old('introduction', $user->introduction) }}</textarea>
        @error('introduction')
          <p class="text-danger small">{{ $message }}</p>
        @enderror
      </div>
      <div class="text-center">
        <div class="col-5 mx-auto justify-content-center">
          <button type="submit" class="btn btn-warning w-100">Update</button>
        </div>
        <a href="{{ route('profile.show', $user->id) }}" class="d-block text-dark mt-2">Cancel</a>
      </div>
    </form>
  </div>
@endsection