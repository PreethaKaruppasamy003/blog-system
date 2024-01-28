<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    public function __construct()
    {
       
    }

    public function index(Request $request)
    {
       
        $sort_search = null;
        $blogs = Blog::where('user_id',Auth::id())->orderBy('created_at', 'desc');

        if ($request->search != null){
            $blogs = $blogs->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $blogs = $blogs->paginate(10);

        return view('blog.index', compact('blogs','sort_search'));
    }

    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('blog.create', compact('blog_categories'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'short_description' => 'required',
            'banner' => 'required',

        ], [
            'category_id.required' => 'Must select the category.',
            'title.required' => 'Blog title is required',
            'short_description.required' => 'Short description is required.',
            'banner.required' => 'Banner image is required.',
        ]);


        $imageName = time().'.'.$request->banner->extension();
        $path = $request->banner->move(public_path('blog_images'), $imageName);
        $imageName = 'blog_images/'.$imageName;

        $blog = new Blog;
        $blog->user_id = Auth::id();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $imageName ?? null;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;


        $blog->save();

        session()->flash('success', 'Blog post has been created successfully');
        return redirect()->route('blog.index');
    }



    public function edit($id)
    {
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::all();

        return view('blog.edit', compact('blog','blog_categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'short_description' => 'required',

        ], [
            'category_id.required' => 'Must select the category.',
            'title.required' => 'Blog title is required',
            'short_description.required' => 'Short description is required.',
        ]);

        if ($request->banner) 
        {
            $imageName = time().'.'.$request->banner->extension();
            $path = $request->banner->move(public_path('blog_images'), $imageName);
            $imageName = 'blog_images/'.$imageName;
        }
        

        $blog = Blog::find($id);
        $blog->user_id = Auth::id();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
            if ($request->banner) 
            {
                $blog->banner = $imageName ?? null;
            }
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;

        $blog->save();
       
        session()->flash('success', 'Blog post has been updated successfully');
        return redirect()->route('blog.index');

    }

    public function change_status(Request $request) {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;

        $blog->save();
        return 1;
    }


    public function destroy($id)
    {
        Blog::find($id)->delete();

        session()->flash('error', 'Blog deleted successfully');

        return redirect()->route('blog.index');
    }


    public function all_blog(Request $request) {
        $selected_categories = array();
        $search = null;
        $blogs = Blog::query();

        if ($request->has('search')) {
            $search = $request->search;;
            $blogs->where(function ($q) use ($search) {
                foreach (explode(' ', trim($search)) as $word) {
                    $q->where('title', 'like', '%' . $word . '%')
                        ->orWhere('short_description', 'like', '%' . $word . '%');
                }
            });

            $case1 = $search . '%';
            $case2 = '%' . $search . '%';

            $blogs->orderByRaw("CASE 
                WHEN title LIKE '$case1' THEN 1 
                WHEN title LIKE '$case2' THEN 2 
                ELSE 3 
                END");
        }
        
        if ($request->has('selected_categories')) {
            $selected_categories = $request->selected_categories;
            $blog_categories = BlogCategory::whereIn('category_name', $selected_categories)->pluck('id')->toArray();

            $blogs->whereIn('category_id', $blog_categories);
        }
        
        $blogs = $blogs->where('status', 1)->orderBy('created_at', 'desc')->paginate(3);

        $recent_blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        return view("welcome", compact('blogs', 'selected_categories', 'search', 'recent_blogs'));
    }

    public function blog_details($id) {
        $blog = Blog::where('id', $id)->first();
        $recent_blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        return view("blog_details", compact('blog', 'recent_blogs'));
    }
}
