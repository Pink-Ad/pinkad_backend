<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Session;
use Stripe;
use App\Models\User;
use App\Models\UserDetails;

trait RequestValidation
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */

    public function valid($request)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $valid = $this->validate($request,[
            'card_number'       => 'required|string',
            'card_name'         => 'required|string',
            'card_exp_month'    => 'required',
            'card_exp_year'     => 'required',
            'stripeToken'       => 'required',
            'card_cvv'          => 'required|numeric',
        ]);

        return $valid;
    }

    public function cardvalid($request)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $valid = $this->validate($request,[
            'card_number'       => 'required|string',
            'card_name'         => 'required|string',
            'card_exp_month'    => 'required|numeric',
            'card_exp_year'     => 'required|numeric',
            'card_cvv'          => 'required|numeric',
        ]);

        return $valid;
    }

    public function payment($data)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $data['price'] * 100,
                "currency" => "usd",
                "source" => $data['stripeToken'],
                "description" => "test payment"
        ]);
        return $data;
    }

    public function createNewCard($request)
    {

        $user_id = auth()->user();

        $user = UserDetails::where('user_id',$user_id->id)->first();


        if ($user->stripe_user_id == null) {
            

            $stripeRes = $this->createUserId($user);

            $this->storeUserId($stripeRes,$user);
            
            $stripeNewCardRes = $this->storeNewCard($stripeRes['id'], $request);
        } else {

            $stripeNewCardRes = $this->storeNewCard($user->stripe_user_id,$request);
        }

       return true;

    }

    protected function createUserId($user)
    {
       
        $useremail = auth()->user()->email;

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $customer = $stripe->customers->create([
            'description' => 'Minority Business Circle Customer'.auth()->user()->name,
            'email' => $useremail,
        ]);

        // dd("done");

        return $customer;
    }

    protected function storeUserId($stripeRes, $user, $user_type = null)
    {
        
        $storeRes = UserDetails::where('user_id', $user->user_id)->update([
            'stripe_user_id'     => $stripeRes['id']
        ]);

        return $storeRes;
    }


    protected function storeNewCard($stripe_id, $cardInfo)
    {

        $card_array = array();

        $cardToken = $this->generatedCardToken($cardInfo);


        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $cards = $stripe->paymentMethods->all(['customer' => $stripe_id,'type' => 'card']);

        // return $cards;
        foreach($cards as $mycards){

            array_push($card_array,$mycards['card']['fingerprint']);

        }

        if(in_array($cardToken['card']['fingerprint'], $card_array)){

                return false;
        }else{
            
            $newCard = $stripe->customers->createSource($stripe_id,['source' => $cardToken['id']]);

            return true;
        }
        
    }

    protected function generatedCardToken($cardInfo)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $token = $stripe->tokens->create([
            'card' => [
                'number'    => $cardInfo['card_number'],
                'exp_month' => $cardInfo['card_exp_month'],
                'cvc'       => $cardInfo['card_cvv'],
                'exp_year'  => $cardInfo['card_exp_year'],
                'name'      =>  $cardInfo['card_name'],
            ]
        ]);

        return $token;
    }

    public function subscriptionpayment($data){
        
    }
    

}
