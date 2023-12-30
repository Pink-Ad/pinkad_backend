<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        return view('admin.pages.offers.categories.index',compact('category'));
    }
    public function create()
    {
        return view('admin.pages.offers.categories.create');
    }
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('admin.pages.offers.categories.edit',compact('cat'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_token','_method']);
        Category::where('id',$id)->update($data);
        return redirect()->route('offer-categories.index');
    }
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('offer-categories.index');
    }
    public function categoryApi()
    {
        $category = Category::where('status',1)->get();
        return $category;
    }
}
