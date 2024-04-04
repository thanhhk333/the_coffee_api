@extends('layouts.app')

@section('content')
    <h1>Edit Product Category</h1>
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ $category->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
