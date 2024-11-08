@extends('layouts.app')

@section('title', 'Add New Pet')

@section('content')
<div class="pure-g">
  <div class="pure-u-1">
    <h1>Add New Pet</h1>

    <form class="pure-form pure-form-stacked" action="{{ route('pets.store') }}" method="POST">
      @csrf

      <fieldset>
        <div class="pure-control-group">
          <label>Name</label>
          <input type="text" name="name" value="{{ old('name') }}" placeholder="Pet name" required>
        </div>

        <div class="pure-control-group">
          <label>Category</label>
          <input type="text" name="category_name" value="{{ old('category_name') }}" placeholder="Category Name">
        </div>

        <div class="pure-control-group">
          <label>Tags</label>
          <textarea rows="4" type="text" name="tags" value="{{ old('tags') }}" placeholder="Tags (separated by space)"></textarea>
        </div>

        <div class="pure-control-group">
          <label>Status</label>
          <select name="status" required>
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
          </select>
        </div>

        <div class="pure-button-group" role="group" aria-label="Actions">
          <a href="{{ route('pets.index') }}" class="pure-button">Cancel</a>
          <button type="submit" class="pure-button ">Create Pet</button>
        </div>
      </fieldset>
    </form>
  </div>
</div>
@endsection