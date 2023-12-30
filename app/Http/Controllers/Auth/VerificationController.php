<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? response()->json(['success'=> "Email is verified..."],200)
            : response()->json(['error'=> "Please verify Your Email..."],200);
    }
    public function verify($email, $hash)
    {

        // dd($hash);
        $check = User::where('email', $email)->first();
        if ($check) {
            $startDate = Carbon::parse($check->updated_at);
            $endDate = Carbon::parse(Carbon::now());
            $diff = $startDate->diffInMinutes($endDate);
            if ($diff > 10) {
                return redirect()->route('verification.notice')->withError('Your verification Link has expired...');

                // return redirect()->route('verification.notice')->withError('error');
            }
            if ($check->remember_token == $hash) {
                $check->email_verified_at = Carbon::now();
                $check->save();
                return response()->json(["success"=>"email is verified...."]);
            } else {
                return response()->json(["error"=>"email is not verified...."]);
                // return redirect()->route('verification.notice')->withError('Your verification Link has invalid...');
            }
        } else {
            return response()->json(["error"=>"email is not verified...."]);

            // return redirect()->route('verification.notice')->withError('Invalid User...');
        }
        // return $request->user()->hasVerifiedEmail()
        //                 ? redirect($this->redirectPath())
        //                 : view('pages.notice', [
        //                     'pageTitle' => __('Account Verification')
        //                 ]);
    }
    public function resend()
    {
        // dd(auth('api')->user()->email);
        $verify_token =  $this->generateRandomString(100);
        $data = array();
        $data['verify_token'] = "http://ms-hostingladz.com/DigitalBrand/email/verify/".auth('api')->user()->email."/".$verify_token;
        $cmd = DB::connection('mysql')->table('users')
            ->where('email', auth('api')->user()->email)
            ->update(['remember_token' => $verify_token, 'updated_at' => Carbon::now()]);
        $emailname = User::where('email', auth('api')->user()->email)->first();
        $data['email'] = auth('api')->user()->email;
        Mail::send('admin.pages.email.forgot-pass',['data'=> $data], function($message) {
            $message->to(auth('api')->user()->email, 'Email Verification')->subject
               ('Verify Your Email');
         });

        return response()->json(['success'=>"we've send you email please verify it..."]);

        // return $request->user()->hasVerifiedEmail()
        //                 ? redirect($this->redirectPath())
        //                 : view('pages.notice', [
        //                     'pageTitle' => __('Account Verification')
        //                 ]);
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
    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }
}
