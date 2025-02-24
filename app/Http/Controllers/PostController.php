<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Ensure a user is authenticated before creating a post
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }

        // Get authenticated user
        $user = Auth::user();

        // Create the post and explicitly set the user_id
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $user->id; // Explicitly set user ID
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    

    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403); // Prevent unauthorized users from deleting
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in 'title' and 'content' columns
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->paginate(5);

        return view('posts.index', compact('posts'));
    }
}