<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function store(Request $request) {
        //you can make a separte StoreCommentRequest 
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'blog_id' => 'required|exists:blogs,id'
        ]);
        
        Comment::create($data);
        return back()->with('comment-success', 'Your Comment Has Been Added Successfully');
    }
    
}
