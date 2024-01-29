<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use App\Models\DeletedUser;
use App\Models\Shop;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\SaveImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class EmailTemplateController extends Controller
{
    public function email_my(){

        return view('admin.pages.email.signup_verifications');
        
    }
   

}

