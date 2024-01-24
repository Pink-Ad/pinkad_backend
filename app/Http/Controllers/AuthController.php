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
                // dd($user->seller->status);
                if ($user->seller->status == 0) {
                    Auth::logout();
                    return response()->json([
                        'message' => 'You are Currently De Active Now Kindly Contact to Admin...',
                    ]);
                }
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
                    // 'cover_image' => 'required|image',

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
                // 
                if ($request->has('salesman_id') && $request->salesman_id) {
                    $seller->salesman_id = $request->salesman_id;
                }
                // 
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
                $seller->save();
                $seller_link= $seller->seller_link;
                $data['seller_id'] = $seller->id;
                $data['name'] = $request->name;
                $data['area'] = $request->area_id;
                // $data['branch_name'] = $request->branch_name;
                $data['description'] = $request->description;
                $data['address'] = $request->business_address;
                $data['contact_number'] = $request->shop_contact_number;
                if ($request->has('cover_image')) {
                    $data['logo'] = $this->shop_logo($request->cover_image);
                }
                $shop = Shop::create($data);
                $shop->area = $request->area_id;
                $shop->save();

                // $area_data=Area::where('id',$request->area_id)->get();
                // $city_id=$area_data[0]['city_id'];
                // $city_data=City::where('id',$city_id)->get();
                
                // $area_name=$area_data[0]['name'];
                // $city_name=$city_data[0]['name'];

                // $fbk_message = $request->description." - ". $area_name."," .$city_name."\r\n";
                // $fbk_message .= "Seller Contact: ". $request->whatsapp;
                // if ($request->has('insta_page')) {
                //     $fbk_message .= "\r\nInstagram: ". $request->insta_page;
                // }
                // if ($request->has('faecbook_page')) {
                //     $fbk_message .= "\r\nFacebook Page: ". $request->faecbook_page;
                // }

                // $insta_message = $request->description." - ". $area_name .",". $city_name ."\r\n";
                // $insta_message .= "Seller Contact: ". $request->whatsapp; 

                // // SM Integration
                // $long_live_access_token= Http::post('https://graph.facebook.com/oauth/access_token', [
                //     'grant_type' => 'fb_exchange_token',
                //     'client_id' => '891955272493237',
                //     'client_secret' => 'f7d90606830a650135e5a00e9a92cc48',
                //     'fb_exchange_token' => 'EAAMrOoUsKLUBOZBDLZCf7oXZBcvenxKTiJnZBOSLoEZAufxuZCgR6ZAAnhxeP0ZBSGRHsJEaazzq9NI7RZCbOY1iT6C0BVrZBZBZC2JvfyzczHvP8VaphHzd90pgd54pmE27S9osAm3IJtaYp33AZA13sHTLp74TgP5F95ZBjf0qc8RK47BOHBUf6v9cdnUqmJHVZB2SHwZD',
                // ]);
        
                // $access_token=$long_live_access_token['access_token'];

                // $fbk_posting = Http::post('https://graph.facebook.com/v18.0/106430192447842/photos', [
                //     'url' =>'https://pinkad.pk/portal/public/storage/'.$request->coverimage,
                //     'message' => $fbk_message,
                //     'access_token' => $access_token,
                // ]);
        
                // $inst_container = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media', [
                //     'image_url' =>'https://pinkad.pk/portal/public/storage/'.$request->coverimage,
                //     'caption' => $insta_message,
                //     'access_token' => $access_token,
                // ]); 
                
                // $creation_id=$inst_container['id'];
        
                // $inst_posting = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media_publish', [
                //     'creation_id' => $creation_id,
                //     'access_token' => $access_token,
                // ]); 
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

            $verify_token =  $this->generateRandomString(100);
            $data1 = array();
            $data1['verify_token'] = "http://ms-hostingladz.com/DigitalBrand/email/verify/" . $request->email . "/" . $verify_token;
            $cmd = DB::connection('mysql')->table('users')
                ->where('email', $request->email)
                ->update(['remember_token' => $verify_token, 'updated_at' => Carbon::now()]);
            $data1['email'] = $request->email;
            Mail::send('admin.pages.email.signup_verification', ['data' => $data1], function ($message)use($data1) {
                $message->to($data1['email'], 'Email Verification')->subject('Verify Your Email');
            });


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
