<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
       
    }

    public function logout(Request $request)
    {
        Auth::logout();

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

    public function comment_store(Request $request)
    {

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;


        $comment->save();

        session()->flash('success', 'Comment has been Added successfully');
        return back();

    }

    public function comment_edit($id,$comments)
    {

        $comment = Comment::find($id);
        $comment->comment = $comments;

        $comment->save();

        session()->flash('success', 'Comment has been Updated successfully');
        return back();

    }

    public function comment_destroy($id)
    {
        Comment::find($id)->delete();

        session()->flash('error', 'Comment deleted successfully');

        return back();
    }




}
