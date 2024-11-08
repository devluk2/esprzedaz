@extends('layouts.app')

@section('title', 'Pets')

@section('content')
<style>
    a:hover:before {
        content: 'click me!';
        color: white;
        position: absolute;
        left: 50%;
        top: 50%;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 0.5rem;
        box-shadow: 0 0 1rem 0 rgba(0, 0, 0, 0.2);
        transform: translate(-50%, -50%);
    }
</style>
<a class="pure-g" href="/pets">
    <img class="pets pure-u-1-1" src="{{url('/images/pets.jpg')}}" alt="pets" />
</a>
@endsection