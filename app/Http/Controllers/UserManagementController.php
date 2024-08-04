<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;
use App\Models\SaleMan;
use App\Models\User;
use App\Models\DeletedUser;
use App\Models\Shop;
use App\Models\Area;
use App\Models\City;
use App\Models\Premium_Seller;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class UserManagementController extends Controller
{
    //
    use SaveImage;

    public function index(Request $request)
{
   
        $seller = null;   
        $searchTerm ="";
        if ($request->has('search_term')) {
            $searchTerm = $request->input('search_term');
            $seller = User::
             select('id','name','email','email_verified_at')
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('email', 'like', '%' . $searchTerm . '%')  
            ->orderByDesc('created_at')
            ->get();
        }
        if (empty($searchTerm)) {
            $seller = User::
            select('id','name','email','email_verified_at')
           ->orderByDesc('created_at')
          ->get();
        }

    return view('admin.pages.user_email_verified.index', compact('seller'));
}

 
    public function edit($id)
    {
        $seller = User::find($id);
        return view('admin.pages.user_email_verified.edit', compact('seller'));
    }
    public function update($id, Request $request)
    {
        // $data = $request->except('email_verified_at');
        if($request->email_verified_at == 'yes'){


            $user =  User::find($id);
            $user->email_verified_at = now();
            $user->save();
        
            
        }
        return redirect()->route('all-user.index');
    }
   

  

  
   
  
  
   
  

 

  
}
