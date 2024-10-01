<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function __construct()
    {
        // this will redirect back to the login bage
        $this->middleware('auth')->only('create', 'index');
    }
    /**
     * Display All user blogs
     */
    public function index()
    {
        $blogs = Blog::where('user_id' , Auth::user()->id)->paginate(10);
        return view('site.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // a way to handle authorization insted of middlewares (not recomended)
        // if(Auth::check()){
        //     $categories = Category::get();
        //     return view('site.blogs.create', compact('categories'));
        // }
        // abort(403); // will redirct to the 403 bage -_-
        
        // or we can use Middleware in the constructor
        $categories = Category::get();
        return view('site.blogs.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $image = $request->image;

        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('blogs', $newImageName , 'public');
        // we will need to run php artisan storage:link to access it from the public directory

        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;

        Blog::create($data);

        return back()->with('blog-created-success', 'Your Blog Has Been Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('site.single-blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id){
            $categories = Category::get();
            return view('site.blogs.edit',compact('categories', 'blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($blog->user_id == Auth::user()->id)
        {
            $data = $request->validated();
            if($request->hasFile('image'))
            {
                Storage::delete("public/blogs/$blog->image");

                $image = $request->image;
                $newImageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('blogs', $newImageName , 'public');
                $data['image'] = $newImageName;
            }
            $blog->update($data);
            return back()->with('blog-updated-success', 'Your Blog Has Been Updated Successfully');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id)
        {
            Storage::delete("public/blogs/$blog->image");

            $blog->delete();
            return back()->with('blog-deleted-success', 'Your Blog Has Been Deleted Successfully');
        }
        abort(403);
    }
}
