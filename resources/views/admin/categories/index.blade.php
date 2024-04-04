@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">Product Categories</h1>
        <button id="openModal"
            class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New
            Category</button>

        <div class="ui modal">
            <i class="close icon"></i>
            <div class="header">
                @if (!empty($selectedItem) && isset($selectedItem['id']))
                    Edit Category
                @else
                    Create New Category
                @endif
            </div>
            <div class="content">
                <form
                    action="{{ !empty($selectedItem) && isset($selectedItem['id']) ? route('categories.update', ['category' => $selectedItem['id']]) : route('categories.store') }}"
                    @csrf @if (!empty($selectedItem) && isset($selectedItem['id'])) @method('PUT') @endif>
                    <div class="field">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Name" value="{{ $selectedItem->name ?? '' }}">
                    </div>
                    <div class="field">
                        <label>Description</label>
                        <input type="text" name="desc" placeholder="Description"
                            value="{{ $selectedItem->desc ?? '' }}">
                    </div>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Cancel
                </div>
                <button type="submit" class="ui positive right labeled icon button">
                    Save
                    <i class="checkmark icon"></i>
                </button>
            </div>
            </form>
        </div>
        <ul>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->desc }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center text-lg font-medium flex">

                                <a id="openModaledit" href="{{ route('categories.index', ['id' => $category->id]) }}"
                                    class="ml-4 text-indigo-600 hover:text-indigo-900 mr-5 edit-button">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"><span><i
                                                class="fa-solid fa-trash-can"></i></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </ul>



        <script>
            document.getElementById('openModal').addEventListener('click', function() {
                $('.ui.modal').modal('show');
            });
            document.getElementById('openModaledit').addEventListener('click', function() {
                $('.ui.modal').modal('show');
            });



            // document.addEventListener('DOMContentLoaded', function() {
            //     var editButtons = document.querySelectorAll('.edit-button');
            //     editButtons.forEach(function(button) {
            //         button.addEventListener('click', function(e) {
            //             e.preventDefault();
            //             var id = this.getAttribute('data-id');
            //             console.log(id); // For debugging purposes
            //         });
            //     });
            // });
        </script>
    </div>
@endsection
