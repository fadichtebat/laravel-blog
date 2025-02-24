@extends('layouts.app')

@section('title', 'Create a New Post - Laravel Blog')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="text-center fw-bold text-primary mb-4">Create a New Post</h2>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <!-- Title Input -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">Title</label>
                            <input type="text" name="title" class="form-control shadow-sm" placeholder="Enter post title" required>
                        </div>

                        <!-- Content Input -->
                        <div class="form-group mb-3">
                            <label class="fw-bold">Content</label>
                            <textarea name="content" class="form-control shadow-sm" rows="5" placeholder="Write your content here..." required></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">Publish Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
