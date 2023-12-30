<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SaveImage
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function cnic_image($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'cnic_image/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'cnic_image/'),$filenamenew);
        return $filenamepath;
    }

    public function work_history($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'work_history/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'work_history/'),$filenamenew);
        return $filenamepath;
    }

    public function picture($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'picture/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'picture/'),$filenamenew);
        return $filenamepath;

    }
    public function seller_logo($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'seller/image/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'seller/image/'),$filenamenew);
        return $filenamepath;

    }

    public function shop_logo($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'shop/logo/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'shop/logo/'),$filenamenew);
        return $filenamepath;

    }
    public function banner_image($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'banner/image/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'banner/image/'),$filenamenew);
        return $filenamepath;

    }
    public function post_banner($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'image'.'/'.'offer/image/'.$filenamenew;
        $filename       = $img->move(public_path('storage/image'.'/'.'offer/image/'),$filenamenew);
        return $filenamepath;

    }
    public function serviceImage($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'service/image'.'/'.'img/'.$filenamenew;
        $filename       = $img->move(public_path('storage/service/image'.'/'.'img'),$filenamenew);
        return $filenamepath;

    }
    public function video($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'video/tutorial/'.$filenamenew;
        $filename       = $img->move(public_path('storage/video/tutorial'),$filenamenew);
        return $filenamepath;

    }
    public function thumbnail($image)
    {
        $img = $image;
        $number = rand(1,999);
        $numb = $number / 7 ;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
        $filenamepath   = 'video/thumbnail/'.$filenamenew;
        $filename       = $img->move(public_path('storage/video/thumbnail'),$filenamenew);
        return $filenamepath;

    }
}
