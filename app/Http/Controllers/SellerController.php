<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use App\Models\DeletedUser;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Validator;


class SellerController extends Controller
{
    //
    use SaveImage;
    public function validator($data)
    {
        $valid =  Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'phone' => ['required', 'string'],
            // 'whatsapp' => ['required', 'string'],
            // 'business_name' => ['required', 'string'],
            // 'business_address' => ['required', 'string'],
            // 'faecbook_page' => ['required', 'string'],
            // 'insta_page' => ['required', 'string'],
            // 'web_url' => ['required', 'string'],
            'isFeatured' => ['required', 'numeric'],
            // 'logo' => ['required', 'image'],
        ]);
        return $valid;
    }
    public function index()
    {
        $seller = Seller::all();
        return view('admin.pages.sellers.sellers', compact('seller'));
    }
    public function create()
    {
        // $seller = Seller::all();
        return view('admin.pages.sellers.create');
    }
    public function edit($id)
    {
        $seller = Seller::find($id);
        return view('admin.pages.sellers.edit', compact('seller'));
    }
    public function update($id, Request $request)
    {
        $data = $request->except(['_token', '_method', 'name', 'logo', 'coverimage']);
        Seller::where('id', $id)->update($data);
        $seller = Seller::find($id);
        if ($request->has('coverimage') && $request->coverimage) {
            $seller->coverimage = $this->seller_logo($request->coverimage);
        }
        if ($request->has('logo') && $request->logo) {
            $seller->logo = $this->seller_logo($request->logo);
        }
        $seller->save();
        return redirect()->route('seller-management.index');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $user = User::create([
            "name" => $request->first_name . " " . $request->last_name,
            "email" => $request->email,
            "role" => 2,
            "password" => Hash::make("12345678"),
        ]);
        $NEW_SELLER = Seller::latest()->first();
        if (empty($NEW_SELLER)) {
            $expNum[1] = 0;
        } else {
            $expNum = explode('-', $NEW_SELLER->SELL_ID);
        }
        $id = 'SELLER-000' . $expNum[1] + 1;
        $seller = new Seller();
        $seller->SELL_ID = $id;
        $seller->user_id = $user->id;
        if ($request->has('business_name') && $request->business_name) {
            $seller->business_name = $request->business_name;
        }
        if ($request->has('business_address') && $request->business_address) {
            $seller->business_address = $request->business_address;
        }
        if ($request->has('faecbook_page') && $request->faecbook_page) {
            $seller->faecbook_page = $request->faecbook_page;
        }
        if ($request->has('insta_page') && $request->insta_page) {
            $seller->insta_page = $request->insta_page;
        }
        if ($request->has('phone') && $request->phone) {
            $seller->phone = $request->phone;
        }
        if ($request->has('whatsapp') && $request->whatsapp) {
            $seller->whatsapp = $request->whatsapp;
        }
        if ($request->has('web_url') && $request->web_url) {
            $seller->web_url = $request->web_url;
        }
        if ($request->has('isFeatured') && $request->isFeatured) {
            $seller->isFeatured = $request->isFeatured;
        }
        if ($request->has('logo') && $request->logo) {
            $seller->logo = $this->seller_logo($request->logo);
        }
        $seller->save();
        return redirect()->route('seller-management.index');
    }
    public function destroy($id)
    {
        $seller = Seller::find($id);
        $user = User::find($seller->user_id);
        $del = DeletedUser::create([
            'name' => $user->name,
            'email' => $user->email,
            'role'  => $user->role,
        ]);
        $user->delete();
        return redirect()->back();
    }
    public function ApiDestroy()
    {
        if (auth('api')->user()) {
            $role = "";
            if (auth('api')->user()->role == 2) {
                $role = "seller";
            } elseif (auth('api')->user()->role == 3) {
                $role = "customer";
            } else {
                $role = "salesman";
            }
            $del = DeletedUser::create([
                'name' => auth('api')->user()->name,
                'email' => auth('api')->user()->email,
                'role'  => $role,
            ]);
            $id = auth('api')->user()->id;
            $seller = User::find($id);
            $seller->delete();
            return true;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }
    public function Apistore(Request $request)
    {
        // dd($request->all());
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            $check = Seller::where('user_id', $request->user_id)->first();

            if ($check == null) {
                $seller = new Seller();
                $seller->user_id = $request->user_id;
            } else {
                $seller = $check;
            }
            if ($request->has('business_name') && $request->business_name) {
                $seller->business_name = $request->business_name;
            }

            if ($request->has('business_address') && $request->business_address) {
                $seller->business_address = $request->business_address;
            }
            if ($request->has('faecbook_page') && $request->faecbook_page) {
                $seller->faecbook_page = $request->faecbook_page;
            }
            if ($request->has('insta_page') && $request->insta_page) {
                $seller->insta_page = $request->insta_page;
            }
            if ($request->has('phone') && $request->phone) {
                $seller->phone = $request->phone;
            }
            if ($request->has('whatsapp') && $request->whatsapp) {
                $seller->whatsapp = $request->whatsapp;
            }
            if ($request->has('web_url') && $request->web_url) {
                $seller->web_url = $request->web_url;
            }
            if ($request->has('isFeatured') && $request->isFeatured) {
                $seller->isFeatured = $request->isFeatured;
            }
            if ($request->has('logo') && $request->logo) {
                $seller->logo = $this->seller_logo($request->logo);
            }
            if ($request->has('coverimage') && $request->coverimage) {
                $seller->coverimage = $this->seller_logo($request->coverimage);
            }
            $seller->save();
            if($request->has('shop_id'))
            {
                $data['seller_id'] = $seller->id;
                if($request->has('shop_name'))
                {
                    $data['name'] = $request->shop_name;
                }
                if($request->has('area_id'))
                {
                    $data['area'] = $request->area_id;
                }
                if($request->has('branch_name'))
                {
                    $data['branch_name'] = $request->branch_name;
                }
                if($request->has('description'))
                {
                    $data['description'] = $request->description;
                }
                if($request->has('business_address'))
                {
                    $data['address'] = $request->business_address;
                }
                if($request->has('shop_contact_number'))
                {
                    $data['contact_number'] = $request->shop_contact_number;
                }
                if ($request->has('shop_cover_image')) {
                    $data['logo'] = $this->shop_logo($request->shop_cover_image);
                }
                $shop = Shop::where('id',$request->shop_id)->update($data);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Seller has been updated Successfully...',
        ]);
    }
    public function change_status($status, $id)
    {
        $seller = Seller::find($id);
        $seller->status = $status;
        $seller->save();
        return response()->json(['message' => "Status has successfully changed..."]);
    }
    public function featured_selller_list()
    {
        $seller = Seller::with('user', 'shop')->where('isFeatured', 1)->paginate(10);
        return $seller;
    }
    public function top_selller_list()
    {
        $seller = Seller::with('user', 'shop')->orderBy('id', 'DESC')->paginate(10);
        return $seller;
    }
    public function all_selller_list()
    {
        $seller = Seller::with('user', 'shop')->orderBy('business_name')->get();
        return $seller;
    }
}
