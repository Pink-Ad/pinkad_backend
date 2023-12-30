<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class FeedBackController extends Controller
{
    //
    public function validator($data)
    {
        $valid =  Validator::make($data, [
            'name' => ['required', 'string'],
            'contact' => ['required'],
            'feedback' => ['required', 'string'],
        ]);
        return $valid;
    }
    public function index()
    {
        $feed = FeedBack::all();
        return view('admin.pages.feedbacks.index',compact('feed'));
    }
    public function store(Request $request)
    {
        try
        {
            $this->validator($request->all());
            $data = $request->all();
            FeedBack::create($data);
            return response()->json(['message'=>"Feedback has been created Successfully..."]);
        }
        catch(Exception $ex)
        {
            return response()->json(['error'=>$ex->getMessage()]);
        }
    }
}
