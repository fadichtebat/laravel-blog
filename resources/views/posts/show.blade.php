@extends('layouts.app')

@section('title', $post->title . ' - Laravel Blog')

@section('content')
<div class="container mt-4">
    <!-- Post Details -->
    <div class="card shadow-sm border-0 p-4 mb-4">
        <h1 class="fw-bold text-primary">{{ $post->title }}</h1>
        <p class="text-secondary small">
            By: <strong>{{ $post->user->name }}</strong> • 
            <span class="text-muted">{{ $post->created_at->format('F j, Y g:i A') }}</span>
        </p>
        <p class="lead">{{ $post->content }}</p>

        @if(auth()->id() === $post->user_id)
            <div class="d-flex gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm px-3">
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
                    <button type="button" class="btn btn-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash"></i> Delete
                    </button>

                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
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

    <!-- Comments Section -->
    <div class="mt-5">
        <h3 class="fw-bold text-secondary">Comments</h3>

        @foreach ($post->comments as $comment)
            <div class="card my-3 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-1">{{ $comment->user->name }}</h6>
                    <p class="mb-1">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Comment Form -->
    @if(auth()->check())
        <div class="mt-4">
            <h4 class="text-secondary">Add a Comment</h4>
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea name="content" class="form-control shadow-sm" rows="3" placeholder="Write a comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-chat-right-text"></i> Post Comment
                </button>
            </form>
        </div>
    @else
        <p class="mt-3"><a href="{{ route('login') }}">Log in</a> to post a comment.</p>
    @endif
</div>
@endsection
