<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class IndexController extends Controller
{
    //
    public function index()
    {
        // Get published posts - sort by ID desc
        $posts = Post::where('is_published',true)->orderBy('id', 'desc')->get();

        // Get featured posts
        $featured_posts = Post::where('is_published',true)->where('is_featured',true)->get();

        // Get all categories
        $categories = Category::all();

        // Get all tags
        $tags = Tag::all();

        // Get last 5 posts
        $recent_posts = Post::where('is_published',true)->orderBy('created_at','desc')->take(5)->get();

        // Return to relevant view
        return view('home', array (
            'posts' => $posts,
            'featured_posts' => $featured_posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ));
    }
}
