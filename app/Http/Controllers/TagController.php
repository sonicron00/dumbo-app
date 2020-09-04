<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class TagController extends Controller
{
    //
    public function index($slug) {
        // Get requested tag
        $tag = Tag::query()->where('slug', $slug)->first();

        // Get posts with the tag
        $posts = $tag->posts();

        // Gets all categories
        $categories = Category::all();

        // All tags
        $tags = Tag::all();

        // Last 5 posts
        $recent_posts = Post::where('is_published',true)->orderBy('created_at', 'desc')->take(5)->get();

        // Return data to relevant view
        return view('tag', array (
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ));
    }
}


