<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Area;
use App\Models\City;
use App\Models\Customer;
use App\Models\SaleMan;
use App\Models\Saleman_comision_details;
use App\Traits\SaveImage;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Facebook\Facebook;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    use SaveImage;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['seller_login', 'customer_login', 'register', 'salesman_login']]);
    }

    public function seller_login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'role' => 'required|numeric|In:2',
            ]);

            $credentials = $request->only('email', 'password');
            $check = User::where('email', $request->email)->where('role', $request->role)->first();

            if ($check) {
                $token = auth('api')->attempt($credentials);
                
                if (!$token) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized',
                    ], 401);
                }

                $user = auth('api')->user();
                $shop_data=Shop::where('seller_id', $user->seller->id)->get();
                
                $area_data=Area::where('id',$shop_data[0]['area'])->get();

                $city_id=$area_data[0]['city_id'];
                $city_data=City::where('id',$city_id)->get();

                $area_name=$area_data[0]['name'];
                $city_name=$city_data[0]['name'];

                if ($user->seller->status == 0) {
                    Auth::logout();
                    return response()->json([
                        'message' => 'You are Currently De Active Now Kindly Contact to Admin...',
                    ]);
                }

                return response()->json([
                    'status' => 'success',
                    'shop' => $shop_data,
                    'city_id' => $city_id,
                    'city_name' => $city_name,
                    'area_name' => $area_name,
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => "Invalid Credentials..."
                ], 401);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
    public function customer_login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string',
                'role' => 'required|numeric|In:3',
            ]);
            $credentials = $request->only('email', 'password');
            $check = User::where('email', $request->email)->where('role', $request->role)->first();
            if ($check) {
                $token = auth('api')->attempt($credentials);
                if (!$token) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized',
                    ], 401);
                }

                $user = auth('api')->user();
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Invalid Credentials..."
                ], 401);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }


    public function salesman_login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'role' => 'required|numeric|In:4',
            ]);
            $credentials = $request->only('email', 'password');
            $check = User::where('email', $request->email)->where('role', $request->role)->first();
            if ($check) {
                $token = auth('api')->attempt($credentials);
                // dd($token);
                if (!$token) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized',
                    ], 401);
                }

                $user = auth('api')->user();
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Invalid Credentials..."
                ], 401);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }
    public function register(Request $request)
    {
        $message=null;
        try {
           $seller_link = null;
            if ($request->role == 2) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6',
                    'role' => 'required|numeric|In:2,3',
                    'phone' => 'required|string',
                    'whatsapp' => 'required|string|unique:seller',
                    'area_id' => 'required|numeric|exists:area,id',
                ]);

                $request->validate([
                    'isFeatured' => 'required|string',
                    'logo' => 'required|image',
                    'reference' => 'required|string',
                    // 'shop_name' => 'required|string',
                    // 'branch_name' => 'required|string',
                    'description' => 'required|string',
                    'shop_contact_number' => 'required|string',
                    // 'business_name' => 'required|string',
                    'business_address' => 'required|string',
                    'coverimage' => 'required|image',
                ]);

                if ($request->reference == "salesman") {
                    $request->validate([
                        'salesman_id' => 'required|numeric|exists:salemans,id',
                    ]);
                }
            }

            if ($request->role == 2){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            $credentials = $request->only('email', 'password');
            $token = auth('api')->attempt($credentials);
        }
            elseif ($request->role == 3){
                $user = User::create([
                    'name' => 'guest',
                    'email' => 'guest@email.com',
                    "password" => Hash::make("12345678"),
                    'role' => 3,
                    ]);
                    // $credentials = $request->only('email', 'password');
                    $token = Str::random(40);
            }
            if ($request->role == 2) {
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
                if ($request->has('reference')) {
                    $seller->reference = $request->reference;

                    if ($request->reference == "salesman") {
                        $seller->salesman_id = $request->salesman_id;
                    } else {
                        $seller->salesman_id = 0;
                    }
                }
                if ($request->has('coverimage')) {
                    $seller->coverimage = $this->seller_logo($request->coverimage);
                }
                $seller->save();
                $seller->seller_link = 'https://www.pinkad.pk/seller?id='.$seller->id;
                 // for salesman
                 if ($request->has('salesman_id') && $request->salesman_id) {
                    $seller->salesman_id = $request->salesman_id;
                    $saleman = SaleMan::find($request->salesman_id);
                    $saleman->total_balance = $saleman->total_balance+$saleman->comission_amount;
                    $saleman->total_sellers  =   $saleman->total_sellers+1;
                    $saleman->save();

                    $saleman_commision_details = new Saleman_comision_details();
                    $saleman_commision_details->date = now()->toDateString(); 
                    $saleman_commision_details->req_type = 'deposit';
                    $saleman_commision_details->seller_id =$seller->id; ;
                    $saleman_commision_details->salesman_id = $request->salesman_id;
                    $saleman_commision_details->amount =$saleman->comission_amount;
                    $saleman_commision_details->closing_balance = $saleman->total_balance;
                    $saleman_commision_details->save();
                    // 
                   
                }
                 // for salesman 
                $seller->save();
                $seller_link= $seller->seller_link;
                $data['seller_id'] = $seller->id;
                $data['name'] = $request->name;
                $data['area'] = $request->area_id;
                $data['branch_name'] = 'common';
                $data['status'] = 1;
                $data['description'] = $request->description;
                $data['address'] = $request->business_address;
                $data['contact_number'] = $request->shop_contact_number;
                if ($request->has('cover_image')) {
                    $data['logo'] = $this->shop_logo($request->cover_image);
                }
                $shop = Shop::create($data);
                if (!$shop) {
                    // Handle shop creation failure
                    return response()->json(['error' => 'Failed to create shop'], 500);
                }


                           // Fetch area data
                $area_data = Area::where('id', $request->area_id)->first();
                
                if (!$area_data) {
                    return response()->json(['status' => 'error', 'message' => 'Area data not found'], 404);
                }
                
                // Fetch city data
                $city_data = City::where('id', $area_data->city_id)->first();
                
                if (!$city_data) {
                    return response()->json(['status' => 'error', 'message' => 'City data not found'], 404);
                }
                
                // Prepare message strings
                $area_name = $area_data->name;
                $city_name = $city_data->name;
                
                $fbk_message = $request->business_name . " - " . $area_name . ", " . $city_name . "\r\n";
                $fbk_message .= "Seller Contact: " . $request->whatsapp;
                if ($request->has('insta_page')) {
                    $fbk_message .= "\r\nInstagram: " . $request->insta_page;
                }
                if ($request->has('faecbook_page')) {
                    $fbk_message .= "\r\nFacebook Page: " . $request->faecbook_page;
                }
                
                $insta_message = $request->business_name . " - " . $area_name . ", " . $city_name . "\r\n";
                $insta_message .= "Seller Contact: " . $request->whatsapp;
                
                // SM Integration
                // $response = Http::post('https://graph.facebook.com/oauth/access_token', [
                //     'grant_type' => 'fb_exchange_token',
                //     'client_id' => '891955272493237',
                //     'client_secret' => 'f7d90606830a650135e5a00e9a92cc48',
                //     'fb_exchange_token' => 'EAAMrOoUsKLUBO5hggGcTnRdqy350yesPe8zYquYJRTKmlP3qbS3NhWziwK8K4x9ZAQtBZAbwLU72ZAkl8Cv4A986ly1sslt3a4l8OpB3Fzp5jj1I1s8U6nQXMmqWlsEn5KxOh7GCGzDnKhgJfSC19ZB9yy7WR4p68OTAvVjWUCZABlFuFDRpShMKYhQZDZD',
                // ]);
                
                // $long_live_access_token = json_decode($response->body(), true)['access_token'];
                
                // $fbk_posting = Http::post('https://graph.facebook.com/v18.0/106430192447842/photos', [
                //     'url' => 'https://pinkad.pk/portal/public/storage/' . $seller->coverimage,
                //     'message' => $fbk_message,
                //     'access_token' => $long_live_access_token,
                // ]);
                
                // if ($fbk_posting->successful()) {
                //     $inst_container = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media', [
                //         'image_url' => 'https://pinkad.pk/portal/public/storage/' . $seller->coverimage,
                //         'caption' => $insta_message,
                //         'access_token' => $long_live_access_token,
                //     ]);
                
                //     if ($inst_container->successful()) {
                //         $creation_id = json_decode($inst_container->body(), true)['id'];
                
                //         $inst_posting = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media_publish', [
                //             'creation_id' => $creation_id,
                //             'access_token' => $long_live_access_token,
                //         ]);
                
                //         if ($inst_posting->successful()) {
                //             return response()->json(['status' => 'success', 'message' => 'Media posted successfully'], 200);
                //         } else {
                //             return response()->json(['status' => 'error', 'message' => 'Error publishing media'], 500);
                //         }
                //     } else {
                //         return response()->json(['status' => 'error', 'message' => 'Error creating media container'], 500);
                //     }
                // } else {
                //     return response()->json(['status' => 'error', 'message' => 'Error posting media on Facebook'], 500);
                // }

            }
        
            elseif ($request->role == 3) {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->area_id =1;

                if ($request->has('business_name') && $request->business_name) {
                    $customer->business_name = $request->business_name;
                }

                if ($request->has('business_address') && $request->business_address) {
                    $customer->business_address = $request->business_address;
                }
                if ($request->has('faecbook_page') && $request->faecbook_page) {
                    $customer->fb_page = $request->faecbook_page;
                }
                if ($request->has('insta_page') && $request->insta_page) {
                    $customer->insta_page = $request->insta_page;
                }
                if ($request->has('phone') && $request->phone) {
                    $customer->phone = $request->phone;
                }
                if ($request->has('whatsapp') && $request->whatsapp) {
                    $customer->whatsapp = $request->whatsapp;
                }
                if ($request->has('web_url') && $request->web_url) {
                    $customer->web_url = $request->web_url;
                }
                $customer->save();
                $seller_link= 'guest_link';
            }

  if ($request->role == 2) {
            $verify_token =  $this->generateRandomString(100);
            $data1 = array();
            $data1['verify_token'] = "http://ms-hostingladz.com/DigitalBrand/email/verify/".$request->email."/".$verify_token;
            $cmd = DB::connection('mysql')->table('users')
                ->where('email', $request->email)
                ->update(['remember_token' => $verify_token, 'updated_at' => Carbon::now()]);
            $data1['email'] = $request->email;
            Mail::send('admin.pages.email.signup_verifications',['data' => $data1], function ($message)use($data1) {
                $message->to($data1['email'], 'Email Verification')->subject('Verify Your Email');
            });

        }


            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'seller_link' => $seller_link,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

       public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => auth('api')->user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
