<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\SaveImage;

class VideoController extends Controller
{
    //
    use SaveImage;
    public function validator($data)
    {
        $valid =  Validator::make($data, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'video' => ['required','mimes:mp4','max:50000'],
            'thumbnail' => ['required','mimes:jpeg,jpg,png','max:20000'],
        ]);
        return $valid;
    }
    public function index()
    {
        $video = Video::all();
        return view('admin.pages.tutorials.seller-guide.index',compact('video'));
    }
    public function create()
    {
        return view('admin.pages.tutorials.seller-guide.create');
    }
    public function video_list()
    {
        $video = Video::where('status',1)->get();
        return $video;
    }
    public function store(Request $request)
    {
        try
        {
            $this->validator($request->all());
            $data = $request->all();
            $video = $this->video($request->video);
            $thumb = $this->thumbnail($request->thumbnail);
            $data['video'] = $video;
            $data['thumbnail'] = $thumb;
            Video::create($data);
            return redirect()->route('video-management.index');
        }
        catch(Exception $ex)
        {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
