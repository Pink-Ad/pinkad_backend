<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCatogory;
use Illuminate\Http\Request;
class SubCatogoryController extends Controller
{
    //
    public function index()
    {
        $subcat = SubCatogory::with('category')->get();
        return view('admin.pages.offers.sub-categories.index',compact('subcat'));
    }
    public function create()
    {
        $category = Category::where('status', 1)->get();
        return view('admin.pages.offers.sub-categories.create',compact('category'));
    }
    public function destroy($id)
    {
        $subcat = SubCatogory::find($id);
        $subcat->delete();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        SubCatogory::create($request->all());
        return redirect()->route('offer-sub-categories.index');
    }
    public function edit($id)
    {
        $cat = Category::get();
        $subcat = SubCatogory::find($id);
        return view('admin.pages.offers.sub-categories.edit',compact('cat','subcat'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_token','_method']);
        SubCatogory::where('id',$id)->update($data);
        return redirect()->route('offer-sub-categories.index');
    }
    public function subcategoryApi(Request $request)
    {
        $category = SubCatogory::where('category_id',$request->cat_id)->where('status',1)->get();
        return $category;
    }
}
