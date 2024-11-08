@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
<div class="pure-g">
  <div class="pure-u-1">
    <h1>Edit Pet</h1>

    <form class="pure-form pure-form-stacked" action="{{ route('pets.update', $pet['id']) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{ $pet['id'] }}">

      <fieldset>
        <div class="pure-control-group">
          <label>Name</label>
          <input type="text" name="name" value="{{ old('name', $pet['name']) }}" placeholder="Pet name" required>
        </div>

        <div class="pure-control-group">
          <label>Category</label>
          <input type="text" name="category_name" value="{{ old('category_name', isset($pet['category']) ? $pet['category']['name'] : '') }}" placeholder="Category Name">
        </div>

        <div class="pure-control-group">
          <label>Upload Image</label>
          <input type="file" name="image" accept="image/*">
        </div>

        <div class="pure-control-group">
          <label>Tags</label>
          <textarea rows="4" type="text" name="tags" placeholder="Tags (separated by space)">{{ old('tags', collect($pet['tags'])->pluck('name')->implode(' ')) }}</textarea>
        </div>

        <div class="pure-control-group">
          <label>Status</label>
          <select name="status" required>
            <option value="available" {{ old('status', $pet['status']) == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status', $pet['status']) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status', $pet['status']) == 'sold' ? 'selected' : '' }}>Sold</option>
          </select>
        </div>

        <div class="pure-button-group" role="group" aria-label="Actions">
          <a href="{{ route('pets.index') }}" class="pure-button">Cancel</a>
          <button type="submit" class="pure-button ">Update Pet</button>
        </div>
      </fieldset>
    </form>
  </div>
</div>
@endsection