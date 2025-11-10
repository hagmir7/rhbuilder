<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index()
    {
        $posts = Post::with('service')->get();
        return response()->json($posts);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $post = Post::create($validator->validated());

        return response()->json($post, 201);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post->load('service');
        return response()->json($post);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $post->update($validator->validated());

        return response()->json($post);
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->hasRole('admin')) {
            $post->delete();
            return response()->json(['message' => 'Besoin supprimé avec succès']);
        }

        return response()->json(['message' => 'Non autorisé'], 403);
    }
}
