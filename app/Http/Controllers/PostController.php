<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\DB;

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

        //related posts
        $related_posts = Post::where('is_published',true)->whereHas('tags', function ($q) use ($post) {
            return $q->whereIn('name', $post->tags->pluck('name'));
        })->where('id', '!=', $post->id)->take(3)->get();

        // Return data to relevant view
        return view('post', array (
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts,
            'related_posts' => $related_posts
        ));
    }

    public function create() {
        // Gets all categories
        $categories = Category::all();

        // All tags
        $tags = Tag::all();

        // Last 5 posts
        $recent_posts = Post::where('is_published',true)->orderBy('created_at', 'desc')->take(5)->get();

        return view('create', array (
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ));
    }

    public function doCreate(Request $request) {
        $title = trim($request->get('post-title'));
        $body = trim($request->get('post-content'));
        $time = time();
        $timestamp = date("Y-m-d",$time);
        $slug = $this->generateRandomString();

        DB::table('posts')->insert([
            ['title' => $title, 'category_id' => '1', 'content' => $body, 'featured_image' => 'none', 'is_published' => '1', 'user_id' => '1', 'slug' => $slug, 'created_at' => $timestamp]
        ]);

    }

    private function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
   }
}

