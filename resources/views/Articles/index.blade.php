@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->category->name ?? 'Uncategorized' }}</td>
                <td>
                        <span class="badge bg-{{ $article->status === 'published' ? 'success' : ($article->status === 'pending' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($article->status) }}
                        </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-primary">View</a>

                        {{-- Role-based actions --}}
                        @if(auth()->user()->id === $article->user_id && $article->status === 'draft')
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        @endif

                        @if(auth()->user()->role->name === 'Editor' && $article->status === 'pending')
                            <a href="{{ route('articles.publish', $article->id) }}" class="btn btn-sm btn-success">Publish</a>
                        @endif

                        @if(auth()->user()->role->name === 'Admin')
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
