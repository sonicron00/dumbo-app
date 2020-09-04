<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class CategoryController extends Controller
{
    //
    public function index($slug) {
        // Get requested category
        $category = Category::query()->where('slug', $slug)->first();

        // Get posts in the category
        $posts = $category->posts();

        // Gets all categories
        $categories = Category::all();

        // All tags
        $tags = Tag::all();

        // Last 5 posts
        $recent_posts = Post::where('is_published',true)->orderBy('created_at', 'desc')->take(5)->get();

        // Return data to relevant view
        return view('category', array (
            'category' => $category,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ));
    }
}
