<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    //
    public function index($slug) {
        // Get requested post if published
        $post = Post::query()->where('is_published', true)->where('slug', $slug)->first();

        // Gets all categories
        $categories = Category::all();

        // All tags
        $tags = Tag::all();

        // Last 5 posts
        $recent_posts = Post::where('is_published',true)->orderBy('created_at', 'desc')->take(5)->get();

        // Return data to relevant view
        return view('post', array (
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ));
    }
}

