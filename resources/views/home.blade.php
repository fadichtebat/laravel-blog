@extends('layouts.app')

@section('title', 'Dashboard - Laravel Blog')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h3 class="fw-bold text-secondary">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="text-muted">You are successfully logged in.</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary px-4">
                        <i class="bi bi-arrow-right-circle"></i> View All Posts
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection