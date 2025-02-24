@extends('layouts.app')

@section('title', 'All Posts - Laravel Blog')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">All Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg"></i> Create New Post
        </a>
    </div>

    <!-- Grid Layout for Posts -->
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5>
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-primary fw-bold">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h5>
                        <p class="text-muted flex-grow-1">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-secondary small">
                            By: <strong>{{ $post->user->name }}</strong> • 
                            <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                        </p>

                        @if(auth()->id() === $post->user_id)
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-warning btn-sm px-3">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                @if($post->comments->count() > 0)
                                    <button type="button" class="btn btn-danger btn-sm px-3 btn-disabled" disabled>
                                        <i class="bi bi-trash"></i> Delete (Disabled - Comments Exist)
                                    </button>
                                @else
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Delete Button triggers modal -->
                                        <button type="button" class="btn btn-outline-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $post->id }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>

                                        <!-- Bootstrap Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $post->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel-{{ $post->id }}">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this post? This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
