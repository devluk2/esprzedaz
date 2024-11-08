@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
@if(session('success'))
<div class="success-message">{{ session('success') }}</div>
@endif

<div class="card">
    <h1>{{ $pet['name'] ?? '(name not specified)' }}</h1>

    <div class="pet-info">
        <p>ID: {{ $pet['id'] }}</p>
        <p>Status: {{ $pet['status'] }}</p>
        @if(isset($pet['category']))
        <p>Category: {{ $pet['category']['name'] }}</p>
        @endif
        @if(isset($pet['tags']) && count($pet['tags']) > 0)
        <p>Tags:
            @foreach($pet['tags'] as $tag)
            <span class="tag">{{ $tag['name'] }}</span>
            @endforeach
        </p>
        @endif
    </div>

    <div class="photo-gallery">
        @if(!empty($pet['photoUrls']))
        @foreach($pet['photoUrls'] as $url)
        <img src="{{ $url }}"
            alt="Photo of {{ $pet['name'] }}"
            class="photo-item"
            onerror="this.src='https://placehold.co/100x100/png?text=N/A'">
        @endforeach
        @endif
    </div>

    <div class="pure-button-group" role="group" aria-label="Actions">
        <a class="pure-button" href="{{ route('pets.index') }}" class="btn btn-secondary">Back to List</a>
        <a class="pure-button" href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-primary">Edit Pet</a>
        <form class="pure-form" action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="pure-button button-small" onclick="return confirm('Are you sure?')">Delete Pet</button>
        </form>
    </div>
</div>
@endsection