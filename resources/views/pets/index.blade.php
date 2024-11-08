@extends('layouts.app')

@section('title', 'Pets List')

@section('content')
<div class="pure-g">
  <div class="pure-u-1">
    <h1>Pets List</h1>

    <div class="pure-g" style="width: 100%; margin-bottom: 1rem;">
      <a href="{{ route('pets.create') }}" class="pure-button">Add New Pet</a>

      <div class="pure-form pure-g" style="margin-left: auto; align-items: center; gap: 1rem;">
        <span style="font-size: 0.8rem;">Filter by status:</span>
        <form method="GET" action="{{ route('pets.index') }}" class="pure-form">
          <select name="status" onchange="this.form.submit()">
            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
          </select>
        </form>
      </div>
    </div>

    <table class="pure-table pure-table-bordered" style="font-size: 0.8rem;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Tags</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pets as $pet)
        <tr>
          <td>{{ $pet['id'] ?? '-' }}</td>
          <td><a href="{{ route('pets.show', $pet['id']) }}">{{ $pet['name'] ?? '-' }}</a></td>
          <td>{{ $pet['category']['name'] ?? '-' }}</td>
          <td>
            @if(isset($pet['tags']))
            @foreach($pet['tags'] as $tag)
            <span class="tag">{{ $tag['name'] }}</span>
            @endforeach
            @else
            -
            @endif
          </td>
          <td>{{ $pet['status'] ?? '-' }}</td>
          <td style="white-space: nowrap;">
            <div class="pure-button-group" role="group" aria-label="Actions">
              <a href="{{ route('pets.show', $pet['id']) }}" class="pure-button button-xsmall">View</a>
              <a href="{{ route('pets.edit', $pet['id']) }}" class="pure-button button-xsmall">Edit</a>
              <form class="pure-form" action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="pure-button button-small" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection