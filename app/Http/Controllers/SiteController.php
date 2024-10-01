<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    public function index() {
        $blogs = Blog::paginate(4);
        $sliderBlogs = Blog::latest()->take(5)->get();
        return view('site.index', compact('blogs','sliderBlogs'));
    }

    public function category($id) {
        $categoryName= Category::find($id)->name;
        $blogs = Blog::where('category_id', $id)->paginate(8);
        return view('site.category', compact('blogs','categoryName'));
    }

    public function contact() {
        return view('site.contact');
    }


}
