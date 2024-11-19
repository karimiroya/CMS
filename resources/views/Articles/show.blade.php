@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h2>{{ $article->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Author:</strong> {{ $article->user->name }}</p>
            <p><strong>Category:</strong> {{ $article->category->name ?? 'Uncategorized' }}</p>
            <p><strong>Status:</strong> <span class="badge bg-{{ $article->status === 'published' ? 'success' : ($article->status === 'pending' ? 'warning' : 'secondary') }}">
                {{ ucfirst($article->status) }}</span></p>
            <hr>
            <p>{{ $article->content }}</p>
        </div>
        <div class="card-footer">
            {{-- Role-based actions --}}
            @if(auth()->user()->id === $article->user_id && $article->status === 'draft')
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
            @endif

            @if(auth()->user()->role->name === 'editor' && $article->status === 'pending')
                <a href="{{ route('articles.publish', $article->id) }}" class="btn btn-success">Publish</a>
            @endif

            @if(auth()->user()->role->name === 'admin')
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endsection
