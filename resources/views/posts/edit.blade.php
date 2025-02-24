@extends('layouts.app')

@section('title', 'Edit ' . $post->title . ' - Laravel Blog')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="text-center fw-bold text-primary mb-4">Edit Post</h2>

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title Input -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">Title</label>
                            <input type="text" name="title" class="form-control shadow-sm" value="{{ old('title', $post->title) }}" required>
                        </div>

                        <!-- Content Input -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">Content</label>
                            <textarea name="content" class="form-control shadow-sm" rows="5" required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
