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

    public function index(Request $request)
{
    // dd('abc');
    $seller = null;

    // Check if the user is authenticated and has role 4
    if (auth()->check() && auth()->user()->role == 4) {
    //    dd('asas');
        $user_id = auth()->user()->id;
        // dd($user_id);
        // Find the salesman using the authenticated user's ID
        $salesman = SaleMan::where('user_id', $user_id)->first();
        //  dd($salesman);

        if ($salesman) {
            // If the salesman is found, retrieve associated sellers
            // $seller = Seller::where('salesman_id', $salesman->id)->get();
            $seller = Seller::where('salesman_id', $salesman->id)->orderBy('created_at', 'desc')->get();
            //    dd($seller);
        } 
        // else {
        //     // Handle case when salesman is not found
        //     // You may display a message or redirect as per your application's logic
        //     return redirect()->back()->with('error', 'Salesman not found.');
        // }
    }
    else if(auth()->check() && auth()->user()->role != 4) {

        // dd('asas');
        // $seller = Seller::all();
        $searchTerm ="";
        if ($request->has('search_term')) {
            $searchTerm = $request->input('search_term');
            $seller = Seller::select('id', 'SELL_ID', 'user_id', 'coverimage', 'phone', 'status','seller_status')
            ->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })
            ->with('user:id,name,email')
            ->orderByDesc('created_at')
            ->get();
        

        }
        if (empty($searchTerm)) {
        $seller = Seller::select('id', 'SELL_ID', 'user_id', 'coverimage', 'phone', 'status','seller_status')
        ->with('user:id,name,email')
        ->orderByDesc('created_at')
        ->get();
        }
    
    
    

    //   return view('sellers.index', ['sellers' => $sellers]);
    }
    // dd($seller);
    
    
    
    
    // else {
    //     // Handle case when user is not authenticated or doesn't have role 4
    //     // You may display a message or redirect as per your application's logic
    //     return redirect()->back()->with('error', 'Unauthorized access.');
    // }
    // dd($seller);

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
         if (auth()->check() && auth()->user()->role == 4) {
            // $user_id = auth()->user()->id;
            // $salesman = SaleMan::where('user_id', $user_id)->first();
            // $seller->salesman_id = $salesman->id;
            // // 
         return redirect()->route('seller-managements.index');
        }
        else{
            return redirect()->route('seller-management.index');
        }
    }
    public function perform_action(Request $request)
    {

        if($request->has('bulk_action'))
        {

            // premium_seller_features
            if($request->bulk_action == "premium" || $request->bulk_action == "ordinary"){
            $sellers = Seller::whereIn('id', $request->sellers)->get();

            foreach ($sellers as $seller) {
                if ($request->bulk_action == "premium") {
                    // Create or update the premium seller status
                    $premiumSeller = Premium_Seller::firstOrNew(['seller_id' => $seller->id]);
                    $premiumSeller->extra_feature = 'accepted';
                    $premiumSeller->save();
                    // 
                    $premium_seller = Seller::find($seller->id);
                    $premium_seller->seller_status = 1;
                    $premium_seller->save();
                    // 
                } elseif ($request->bulk_action == "ordinary") {
                    // Delete the premium seller status if it exists
                    Premium_Seller::where('seller_id', $seller->id)->delete();
                      // 
                      $ordinary_seller = Seller::find($seller->id);
                      $ordinary_seller->seller_status = 0;
                      $ordinary_seller->save();
                      // 
                }
            }
        }
            // premium_seller_features
            if($request->bulk_action == "promote")
            {
                if($request->has('sellers'))
                {
                    foreach($request->sellers as $row)
                    {
                        $seller = Seller::find($row);
                        $shop = Shop::where('seller_id',$seller['id'])->get();
                        $area_data=Area::where('id',$shop[0]['area'])->get();
                        $city_id=$area_data[0]['city_id'];
                        $city_data=City::where('id',$city_id)->get();
                        
                        $area_name=$area_data[0]['name'];
                        $city_name=$city_data[0]['name'];
                        $fbk_message = $shop[0]['description']." - ". $area_name."," .$city_name."\r\n";
                        $fbk_message .= "Seller Contact: ". $seller['whatsapp'];
                        if ($request->has('insta_page')) {
                            $fbk_message .= "\r\nInstagram: ". $seller['insta_page'];
                        }
                        if ($request->has('faecbook_page')) {
                            $fbk_message .= "\r\nFacebook Page: ". $seller['faecbook_page'];
                        }

                        $insta_message = $shop[0]['description']." - ". $area_name .",". $city_name ."\r\n";
                        $insta_message .= "Seller Contact: ". $seller['whatsapp']; 

                        // SM Integration
                        $long_live_access_token= Http::post('https://graph.facebook.com/oauth/access_token', [
                            'grant_type' => 'fb_exchange_token',
                            'client_id' => '891955272493237',
                            'client_secret' => 'f7d90606830a650135e5a00e9a92cc48',
                            'fb_exchange_token' => 'EAAMrOoUsKLUBO3y5fzQeZA8vUHqzZARaLkSpZBh6HvPfdvPo9nZA9K5theYHnon6SWPpZCeN5slxPj8yJnTd8j1uRRlUL0QMrQUZBMOBZCse1n4yM9I3kgm6V6j2nJVyEqUJjHauwNB9i12KbmoPZBvgeq1MZBvrH7YOZBojDLh8hos5Pmv63LMfROSO8U8dtKcUejkujAA500iAZDZD',
                            // 'fb_exchange_token' => 'EAAMrOoUsKLUBO9CKJBqmKY99Xhs4zUY9i85JMuAUX0kZANz2iVfVGZCpl0Wp7VNcM9nojn8sg3ZBK9ZAE5ShNNin0tHSbD3BwQbxVx2dcsDNKxzkgQOw4pBXnZC59RUC3rgJtZAtegRBiTb4CP9dg8gGZClXzlQKXPpPHGBD99IiqjnIzofiwlrIOnP',
                        ]);
                
                        $access_token=$long_live_access_token->json()['access_token'];

                        $fbk_posting = Http::post('https://graph.facebook.com/v18.0/106430192447842/photos', [
                            'url' =>'https://pinkad.pk/portal/public/storage/'.$seller['coverimage'],
                            'message' => $fbk_message,
                            'access_token' => $access_token,
                        ]);
                
                        // $inst_container = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media', [
                        //     'image_url' =>'https://pinkad.pk/portal/public/storage/'.$seller['coverimage'],
                        //     'caption' => $insta_message,
                        //     'access_token' => $access_token,
                        // ]); 
                        // $creation_id=$inst_container['id'];
                
                        // $inst_posting = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media_publish', [
                        //     'creation_id' => $creation_id,
                        //     'access_token' => $access_token,
                        // ]); 
                    }
                }
            }
            if($request->bulk_action == "delete")
            {
                if($request->has('sellers'))
                {
                    foreach($request->sellers as $row)
                    {
                        $seller = Seller::find($row);
                        $seller->delete();
                    }
                }
            }
        }
        return redirect()->back();
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
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $seller->logo = $this->seller_logo($request->file('logo'));
        }
         // 
         if (auth()->check() && auth()->user()->role == 4) {
            // Get the authenticated user's ID
            // dd('asas');
            $user_id = auth()->user()->id;
            $saleman = SaleMan::where('user_id', $user_id)->first();
            $saleman->total_sellers  =   $saleman->total_sellers+1;
            // 
            $saleman->total_balance = $saleman->total_balance+$saleman->comission_amount;
            $saleman->save();
        
            $saleman_commision_details = new Saleman_comision_details();
            $saleman_commision_details->date = now()->toDateString(); 
            $saleman_commision_details->req_type = 'deposit';
            // $saleman_commision_details->seller_id =$seller->id; 
            $saleman_commision_details->salesman_id = $saleman->id;
            $saleman_commision_details->amount =$saleman->comission_amount;
            $saleman_commision_details->closing_balance = $saleman->total_balance;
            $saleman_commision_details->save();
            // 
            $seller->salesman_id = $saleman->id;
            // dd( $seller->salesman_id);
            // 
            $seller->save();
            $saleman_commision_details->seller_id =$seller->id;
            $saleman_commision_details->save();
           return redirect()->route('seller-managements.index');

    
        }
        else{
        $seller->save();
        return redirect()->route('seller-management.index');

    
            
        }
        
    }
    public function destroy($id)
    {
        // dd($id);
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
        $seller=null;
        // dd($request->all());
        $valid = $this->validator($request->all());
        if ($valid->valid()) {
            // 
            $user = User::find($request->user_id);
            if ($user) {
                $user->email = $request->email;; // Update user name or other fields
                // ... other user fields ...
                $user->save();
            }
            // 
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
                    $data['area'] = '785';
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

            $area_data=Area::where('id',$request->area_id)->get();

            $city_id=$area_data[0]['city_id'];
            $city_data=City::where('id',$city_id)->get();
            
            $area_name=$area_data[0]['name'];
            $city_name=$city_data[0]['name'];

            $fbk_message = $request->business_name." - ". $area_name."," .$city_name."\r\n";
            $fbk_message .= "Seller Contact: ". $request->whatsapp;

            if ($request->has('insta_page')) {
                $fbk_message .= "\r\nInstagram: ". $request->insta_page;
            }
            if ($request->has('faecbook_page')) {
                $fbk_message .= "\r\nFacebook Page: ". $request->faecbook_page;
            }

            $insta_message = $request->business_name." - ". $area_name .",". $city_name ."\r\n";
            $insta_message .= "Seller Contact: ". $request->whatsapp; 

            // SM Integration
            // $long_live_access_token= Http::post('https://graph.facebook.com/oauth/access_token', [
            //     'grant_type' => 'fb_exchange_token',
            //     'client_id' => '891955272493237',
            //     'client_secret' => 'f7d90606830a650135e5a00e9a92cc48',
            //     'fb_exchange_token' => 'EAAMrOoUsKLUBOZBDLZCf7oXZBcvenxKTiJnZBOSLoEZAufxuZCgR6ZAAnhxeP0ZBSGRHsJEaazzq9NI7RZCbOY1iT6C0BVrZBZBZC2JvfyzczHvP8VaphHzd90pgd54pmE27S9osAm3IJtaYp33AZA13sHTLp74TgP5F95ZBjf0qc8RK47BOHBUf6v9cdnUqmJHVZB2SHwZD',
            // ]);
    
            // $access_token=$long_live_access_token['access_token'];


            // $fbk_posting = Http::post('https://graph.facebook.com/v18.0/106430192447842/photos', [
            //     'url' =>'https://pinkad.pk/portal/public/storage/'.$seller->coverimage,
            //     'message' => $fbk_message,
            //     'access_token' => $access_token,
            // ]);
            
            // $inst_container = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media', [
            //     'image_url' =>'https://pinkad.pk/portal/public/storage/'.$seller->coverimage,
            //     'caption' => $insta_message,
            //     'access_token' => $access_token,
            // ]); 
            
            // $creation_id=$inst_container['id'];
    
            // $inst_posting = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media_publish', [
            //     'creation_id' => $creation_id,
            //     'access_token' => $access_token,
            // ]);
            
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
        $seller = Seller::with('user', 'shop')->orderBy('id', 'DESC')->get();
        // $seller = Seller::with('user', 'shop')->orderBy('business_name')->get();
        return $seller;
    }

    public function premium_seller_list()
    {
        $premium_seller = Premium_Seller::with('seller','seller.user','seller.shop')
        ->Orderby('id','DESC')->get();
        return $premium_seller;
    }
    
    
    public function filter_seller(Request $request){
        $seller= null;

        if($request->filter_id=="1"){
            $seller = Seller::with('user', 'shop')
            ->orderBy('business_name')
            ->where('status',1)
            ->get();
            $seller = Seller::where('status', 1)->get();
        }
        else if($request->filter_id=="2"){
            $seller = Seller::with('user', 'shop')
            ->orderBy('business_name')
            ->where('status',0)
            ->get();
        }
        else if($request->filter_id=="0"){
            $seller = Seller::with('user', 'shop')
            ->orderBy('business_name')
            ->get();        
        }
        return view('admin.pages.sellers.sellers', compact('seller'));
    }

    public function getSellersByArea(Request $request)
    {
        try {
            $area_id = $request->input('area_id');
     
            if (!$area_id) {
                return response()->json(['error' => 'Please provide an area ID'], 400);
            }
            // $area_id = $request->area_id;
            $sellers = Seller::whereHas('shops', function ($query) use ($area_id) {
                $query->whereIn('area', $area_id);
            })->with(['user', 'shops'])->get();

            return response()->json(['sellers' => $sellers]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function change_password(Request $request)
    {
      
        // Find the user by ID
        $user = User::findOrFail($request->user_id);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 401);
        }

        // Hash the new password
        $newPassword = Hash::make($request->new_password);

        // Update the user's password
        $user->password = $newPassword;
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
