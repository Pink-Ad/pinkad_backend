<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    //
    public function index()
    {
        $area = Area::all();
        return view('admin.pages.locations.Areas.index',compact('area'));
    }
    public function create()
    {
        $city = City::where('status',1)->get();
        return view('admin.pages.locations.Areas.create',compact('city'));
    }
    public function destroy($id)
    {
        $city = Area::find($id);
        $city->delete();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        Area::create($request->all());
        return redirect()->route('area-management.index');
    }
    public function edit($id)
    {
        $city = City::where('status',1)->get();
        $area = Area::find($id);

        return view('admin.pages.locations.Areas.edit',compact('city','area'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_token','_method']);
        Area::where('id',$id)->update($data);
        return redirect()->route('area-management.index');
    }
    public function areaApi(Request $request)
    {
        $area = Area::where('city_id',$request->city_id)->where('status',1)->get();
        return $area;
    }
}
