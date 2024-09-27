<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    public function index() {
        return view('site.index');
    }

    public function category() {
        return view('site.category');
    }

    public function contact() {
        return view('site.contact');
    }

    public function singleBlog() {
        return view('site.single-blog');
    }

    public function login() {
        return view('site.login');
    }

    public function register() {
        return view('site.register');
    }
}
