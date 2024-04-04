@extends('layouts.app')

@section('content')
    <h1>Create Product Category</h1>
    <form method="POST" action="">
        @csrf
        <label for="name">Name</label>
        <input id="name" name="name" type="text" required>
        <button type="submit">Create</button>
    </form>
@endsection
