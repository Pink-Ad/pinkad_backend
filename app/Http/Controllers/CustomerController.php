<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //
    use SaveImage;
    public function validator($data)
    {
        $valid =  Validator::make($data, [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'phone' => ['required', 'string'],
            'whatsapp' => ['required', 'string'],
            'business_name' => ['required', 'string'],
            'business_address' => ['required', 'string'],
            'faecbook_page' => ['required', 'string'],
            'insta_page' => ['required', 'string'],
            'web_url' => ['required', 'string'],
        ]);
        return $valid;
    }
    public function index()
    {
        $customer = Customer::all();
        return view('admin.pages.visitors.visitors',compact('customer'));
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back();
    }
    public function create()
    {
        // $seller = Seller::all();
        return view('admin.pages.visitors.visitor_form');
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.pages.visitors.edit',compact('customer'));
    }
    public function update($id,Request $request)
    {
        $data = $request->except(['_token','_method','name']);
        $customer = Customer::where('id',$id)->update($data);
        return redirect()->route('visitor-management.index');

    }
    public function store(Request $request)
    {
        // dd($request->all());
        $user = User::create([
            "name" => $request->first_name." ".$request->last_name,
            "email" => $request->email,
            "role" => 3,
            "password" => Hash::make("12345678"),
        ]);
        $customer = new Customer();
        $customer->user_id = $user->id;
        if($request->has('business_name') && $request->business_name)
        {
            $customer->business_name = $request->business_name;

        }
        if($request->has('business_address') && $request->business_address)
        {
            $customer->business_address = $request->business_address;

        }
        if($request->has('faecbook_page') && $request->faecbook_page)
        {
            $customer->fb_page = $request->faecbook_page;

        }
        if($request->has('insta_page') && $request->insta_page)
        {
            $customer->insta_page = $request->insta_page;

        }
        if($request->has('phone') && $request->phone)
        {
            $customer->phone = $request->phone;

        }
        if($request->has('whatsapp') && $request->whatsapp)
        {
            $customer->whatsapp = $request->whatsapp;

        }
        if($request->has('web_url') && $request->web_url)
        {
            $customer->web_url = $request->web_url;

        }

        $customer->save();
        return redirect()->route('visitor-management.index');
    }
    // public function Apistore(Request $request)
    // {
    //     $valid = $this->validator($request->all());
    //     if($valid->valid())
    //     {
    //         $check = Seller::where('user_id',$request->user_id)->first();

    //         if($check == null)
    //         {
    //             $seller = new Seller();
    //             $seller->user_id = $request->user_id;
    //         }
    //         else
    //         {
    //             $seller = $check;
    //         }
    //         if($request->has('business_name') && $request->business_name)
    //         {
    //             $seller->business_name = $request->business_name;

    //         }

    //         if($request->has('business_address') && $request->business_address)
    //         {
    //             $seller->business_address = $request->business_address;

    //         }
    //         if($request->has('faecbook_page') && $request->faecbook_page)
    //         {
    //             $seller->faecbook_page = $request->faecbook_page;

    //         }
    //         if($request->has('insta_page') && $request->insta_page)
    //         {
    //             $seller->insta_page = $request->insta_page;

    //         }
    //         if($request->has('phone') && $request->phone)
    //         {
    //             $seller->phone = $request->phone;

    //         }
    //         if($request->has('whatsapp') && $request->whatsapp)
    //         {
    //             $seller->whatsapp = $request->whatsapp;

    //         }
    //         if($request->has('web_url') && $request->web_url)
    //         {
    //             $seller->web_url = $request->web_url;

    //         }
    //         if($request->has('isFeatured') && $request->isFeatured)
    //         {
    //             $seller->isFeatured = $request->isFeatured;

    //         }
    //         if($request->has('logo') && $request->logo)
    //         {
    //             $seller->logo = $this->seller_logo($request->logo);
    //         }
    //         $seller->save();
    //     }
    //     else
    //     {
    //         return response()->json(['status' => 'error',
    //             'message' => $valid->errors()]);
    //     }
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Seller has been updated Successfully...',
    //     ]);
    // }
}
