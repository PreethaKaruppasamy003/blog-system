<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\CategoryImport;
use PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Laracasts\Flash\Flash;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        
    }

    
    public function index(Request $request)
    {
        $sort_search =null;
        $categories = BlogCategory::orderBy('category_name', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('category_name', 'like', '%'.$sort_search.'%');
        }

        $categories = $categories->paginate(5);
        
        return view('category.index', compact('categories', 'sort_search'));
    }
    

   

    public function store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $category = new BlogCategory;

        $category->category_name = $request->category_name;
        $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->category_name));

        $category->save();

        session()->flash('success', 'Blog category has been created successfully');
        return redirect()->route('blog-category.index');
    }

 



    public function edit($id)
    {
        $cateogry = BlogCategory::find($id);
        $all_categories = BlogCategory::all();

        return view('category.edit',  compact('cateogry','all_categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $category = BlogCategory::find($id);

        $category->category_name = $request->category_name;
        $category->save();


         session()->flash('success', 'Blog category has been updated successfully');

        return redirect()->route('blog-category.index');
    }


    public function destroy($id)
    {
        BlogCategory::find($id)->delete();

        session()->flash('error', 'Blog category has been deleted successfully');

        return redirect()->route('blog-category.index');
    }



    public function import_export(Request $request)
    {        
        return view('category.import_export');
    }


    public function pdf_download_category()
    {
        $category = BlogCategory::get();

        return PDF::loadView('category.bulk_category.category_download', [
            'category' => $category,
        ])->download('category.pdf');
    }




    public function bulk_upload(Request $request)
    { 
        if($request->hasFile('bulk_file')){
            Excel::import(new CategoryImport, request()->file('bulk_file'));
        }
        flash(translate('Members imported successfully'))->success();
        return back();
    }







}
