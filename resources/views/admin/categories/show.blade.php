@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>
    <a href="{{ route('categories.edit', $category) }}">Edit</a>
    <form method="POST" action="{{ route('categories.destroy', $category) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
