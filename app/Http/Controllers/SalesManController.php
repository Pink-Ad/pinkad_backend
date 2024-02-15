<?php

namespace App\Http\Controllers;

use App\Models\SaleMan;
use App\Models\User;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Saleman_comision_details;
use App\Models\Seller;


class SalesManController extends Controller
{
    //
    use SaveImage;
    public function index()
    {
        $salesman = SaleMan::all();
        return view('admin.pages.salesman.index',compact('salesman'));
    }
    public function sales_man_list()
    {
        $salesman = SaleMan::with('user')->where('status',1)->get();
        return $salesman;
    }
    public function update($id,Request $request)
    {
        $data = $request->except(['_token','_method','name','email']);
        SaleMan::where('id',$id)->update($data);
        return redirect()->route('salesman-management.index');

    }
    public function create()
    {
        // $salesman = SaleMan::all();
        return view('admin.pages.salesman.create');
    }
    public function edit($id)
    {
        $salesman = SaleMan::find($id);
        return view('admin.pages.salesman.edit',compact('salesman'));
    }
    public function store(Request $request)
    {

        // dd($request->all());
        $user = User::create([
            "name" => $request->first_name." ".$request->last_name,
            "email" => $request->email,
            "role" => 4,
            "password" => Hash::make("12345678"),
        ]);
        $NEW_SALESMAN = SaleMan::latest()->first();
        if(empty($NEW_SALESMAN))
        {
            $expNum[1] = 0;
        }
        else
        {
            $expNum = explode('-', $NEW_SALESMAN->SM_ID);
        }
        $id = 'SM-000'. $expNum[1]+1;
        $sales_man = new SaleMan();
        $sales_man->SM_ID = $id;
        $sales_man->user_id = $user->id;
        if($request->has('phone') && $request->phone)
        {
            $sales_man->phone = $request->phone;

        }
        if($request->has('qualification') && $request->qualification)
        {
            $sales_man->qualification = $request->qualification;

        }
        if($request->has('cnic') && $request->cnic)
        {
            $sales_man->cnic = $request->cnic;

        }
        if($request->has('marital_status') && $request->marital_status)
        {
            $sales_man->marital_status = $request->marital_status;

        }
        if($request->has('religion') && $request->religion)
        {
            $sales_man->religion = $request->religion;

        }
        if($request->has('bank_account') && $request->bank_account)
        {
            $sales_man->bank_account = $request->bank_account;

        }
        if($request->has('age') && $request->age)
        {
            $sales_man->age = $request->age;

        }
        if($request->has('comission_amount') && $request->comission_amount)
        {
            $sales_man->comission_amount = $request->comission_amount;

        }
        if($request->has('address') && $request->address)
        {
            $sales_man->address = $request->address;

        }
        if($request->has('cnic_image') && $request->cnic_image)
        {
            $sales_man->cnic_image = $this->cnic_image($request->cnic_image);
        }
        if($request->has('work_history') && $request->work_history)
        {
            $sales_man->work_history = $this->work_history($request->work_history);
        }
        if($request->has('picture') && $request->picture)
        {
            $sales_man->picture = $this->picture($request->picture);
        }
        $sales_man->save();
    // for salesman
    if ($sales_man) {
        // $seller->salesman_id = $sales_man->id;
        $saleman = SaleMan::find($sales_man->id);
        $saleman->total_balance = $saleman->total_balance+$saleman->comission_amount;
        // $saleman->total_sellers  =   $saleman->total_sellers+1;
        $saleman->save();

        $saleman_commision_details = new Saleman_comision_details();
        $saleman_commision_details->date = now()->toDateString(); 
        $saleman_commision_details->req_type = 'deposit';
        // $saleman_commision_details->seller_id =$seller->id; 
        $saleman_commision_details->salesman_id = $sales_man->id;
        $saleman_commision_details->amount =$saleman->comission_amount;
        $saleman_commision_details->closing_balance = $saleman->total_balance;
        $saleman_commision_details->save();
        // 
    
    
    }
    // for salesman 
        return redirect()->route('salesman-management.index');
    }
    public function destroy($id)
    {
        $seller = Seller::where('salesman_id',$id)->get();
        if(count($seller) > 0)
        {
            $seller->salesman_id = 0;
            $seller->save();
        }
        $salesman = SaleMan::find($id);
        $salesman->delete();
        return redirect()->back();
    }
    
    public function change_status($id,$status)
    {
        $salesman = SaleMan::find($id);
        $salesman->status = $status;
        $salesman->save();
        return redirect()->back();
    }
    // mobile api


    public function get_all_salesman() {
        $sellers = SaleMan::with(['user' => function($query) {
            $query->orderBy('name', 'asc');
        }])->get();
    
        return $sellers;
    }
    
    

}
