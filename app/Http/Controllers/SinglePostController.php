<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class SinglePostController extends Controller
{
    //
    public function index($id)
    {
        // Fetch the post by its ID from the database
        $post = Post::where('slug', $id)->firstOrFail();
        
        // Return the view with the post data
        return view('frontend.pages.single-post', compact('post'));
    }
}
