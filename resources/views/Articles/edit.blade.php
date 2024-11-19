@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Edit Article</h1>
        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="5" class="mt-1 block w-full rounded-md shadow-sm border-gray-300">{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category_id" class="mt-1 block w-full rounded-md shadow-sm border-gray-300">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">Update Article</button>
        </form>
    </div>
@endsection
