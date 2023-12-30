<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Shop;
use App\Models\SubCatogory;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use Exception;

class BannerController extends Controller
{
    //
    use SaveImage;
    public function bannerApi()
    {
        $banners = Banner::where('status',1)->get();
        return $banners;
    }
    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'area' => 'required|numeric|exists:area,id',
                'shop_id' => 'required|numeric|exists:shop,id',
                'subcat_id' => 'required|numeric|exists:sub_category,id',
                'redirect_url' => 'required',
                'image' => 'image|mimes:jpg,bmp,png,webp|max:2048'
            ]);
            if($request->has('image'))
            {
                $image = $this->shop_logo($request->image);
            }
            $data = $request->all();
            $data['image'] = $image;
            $banner = Banner::create($data);
            if($request->has('web'))
            {
                return redirect()->route('banner-management.index');
            }
            return $banner;

        }
        catch(Exception $ex)
        {
            if($request->has('web'))
            {
                return redirect()-back()->withErrors(['error'=> $ex->getMessage()]);
            }
            return response()->json(['error'=> $ex->getMessage()]);
        }
    }
    public function index()
    {
        $banners = Banner::get();
        return view('admin.pages.premium.banners.index',compact('banners'));
    }
    public function create()
    {
        $subcat = SubCatogory::get();
        $shop = Shop::get();
        $area = Area::get();
        return view('admin.pages.premium.banners.create',compact('subcat','shop','area'));
    }
    public function edit($id)
    {
        $banner = Banner::find($id);
        $subcat = SubCatogory::get();
        $shop = Shop::get();
        $area = Area::get();
        return view('admin.pages.premium.banners.edit',compact('subcat','shop','area','banner'));
    }
    public function update(Request $request,$id)
    {
        try
        {
            $this->validate($request, [
                'area' => 'required|numeric|exists:area,id',
                'shop_id' => 'required|numeric|exists:shop,id',
                'subcat_id' => 'required|numeric|exists:sub_category,id',
                'redirect_url' => 'required',
                'image' => 'image|mimes:jpg,bmp,png,webp|max:2048'
            ]);
            $data = $request->except(['_token','_method','image']);
            if($request->has('image'))
            {
                $image = $this->shop_logo($request->image);
                $data['image'] = $image;
            }
            $banner = Banner::where('id',$id)->update($data);

            return redirect()->route('banner-management.index');

        }
        catch(Exception $ex)
        {
            return redirect()-back()->withErrors(['error'=> $ex->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $post = Banner::find($id);
        // dd($post->toArray());
        $post->delete();
        return redirect()->back();
    }
}
