<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    //
    public function index()
    {
        $province= Province::all();
        return view('admin.pages.locations.Provinces.index',compact('province'));
    }
    public function create()
    {
        return view('admin.pages.locations.Provinces.create');
    }
    public function destroy($id)
    {
        $province = Province::find($id);
        $province->delete();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        Province::create($request->all());
        return redirect()->route('province-management.index');
    }
    public function edit($id)
    {
        $province = Province::find($id);
        return view('admin.pages.locations.Provinces.edit',compact('province'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_token','_method']);
        Province::where('id',$id)->update($data);
        return redirect()->route('province-management.index');
    }
    public function provinceApi()
    {
        $province = Province::where('status',1)->get();
        return $province;
    }
}
