<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
class ShopController extends Controller
{
    //
    use SaveImage;
    public function index()
    {
        $shop_list = Shop::with('seller')->get();
        return view('admin.pages.sellers.seller-shops.index',compact('shop_list'));

    }
    public function create_shop_api(Request $request)
    {
        try
        {
            $this->validate($request, [
                // 'name' => 'required',
                'area' => 'required|numeric|exists:area,id',
                'branch_name' => 'required',
                'address' => 'required',
                'contact_number' => 'required',
                'description' => 'required',
                'logo' => 'image|mimes:jpg,bmp,png,webp||max:2048'
            ]);
            if($request->has('logo'))
            {
                $logo = $this->shop_logo($request->logo);
            }
            $seller_id = auth('api')->user()->seller->id;
            $data = $request->all();
            $data['logo'] = $logo;
            $data['seller_id'] = $seller_id;
            $shop = Shop::create($data);
            return $shop;

        }
        catch(Exception $ex)
        {
            return response()->json(['error'=> $ex->getMessage()]);
        }
    }
    public function shop_list()
    {
        $shop_list = Shop::where('seller_id', auth('api')->user()->seller->id)->get();
        return $shop_list;
    }
    public function seller_shop(Request $request)
    {
        $shop_list = Shop::where('seller_id', $request->seller_id)->get();
        return $shop_list;
    }
    public function all_shop_list()
    {
        $all_shop_list = Shop::with('seller')->where('status', 1)->get();
        return $all_shop_list;
    }
    public function shop_details($id)
    {
        $shop_details = Shop::with('seller')->where('status',1)->find($id);
        return $shop_details;
    }
}
