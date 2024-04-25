<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


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
    // public function post_banner($image)
    // {
    //     $img = $image;
    //     $number = rand(1,999);
    //     $numb = $number / 7 ;
    //     $extension      = $img->extension();
    //     $filenamenew    = date('Y-m-d')."_.".$numb."_.".$extension;
    //     $filenamepath   = 'image'.'/'.'offer/image/'.$filenamenew;
    //     $filename       = $img->move(public_path('storage/image'.'/'.'offer/image/'),$filenamenew);
    //     return $filenamepath;

    // }
    // newww 
//     public function post_banner($image)
// {
//     try {
//         $img = $image;
//         $number = rand(1, 999);
//         $numb = $number / 7;
//         $extension = $img->extension();
//         $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;

//         // Set the desired width and height
//         $width = 1080; // Replace with your desired width
//         $height = 1080; // Replace with your desired height

//         // Resize the image
//         $resizedImage = Image::make($img)->resize($width, $height);

//         // Save the resized image to the destination
//         $filenamepath = 'image' . '/' . 'offer/image/' . $filenamenew;
//         $resizedImage->save(public_path('storage/' . $filenamepath));

//         return $filenamepath;

//     } catch (\Exception $e) {
//         // Handle any exceptions that may occur during the process
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }

public function post_banner($image)
{
    try {
        // Convert the image data from bytes to an Intervention Image instance
        $img = Image::make($image);

        // Set the desired width and height for mobile display (adjust as needed)
        $width = 400;
        $height = 600;

        // Resize the image while maintaining aspect ratio
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Compress the image with a quality level of 80 (adjust as needed)
        $img->encode(null, 15);

        // Generate a unique filename with extension
        $filename = 'compressed_' . uniqid() . '.jpg'; // Use a unique filename with the JPEG extension

        // Save the resized and compressed image to the destination
        $filePath = 'image/offer/image/' . $filename; // Change the path as needed
        $img->save(public_path('storage/' . $filePath));

        return $filePath; // Return the file path for reference

    } catch (\Exception $e) {
        // Handle any exceptions that may occur during the process
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
