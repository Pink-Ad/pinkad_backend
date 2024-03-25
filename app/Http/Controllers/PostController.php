<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Area;
use App\Models\City;
use App\Models\OfferSubcatPivot;
use App\Models\OfferareaPivot;
use Exception;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use Facebook\Facebook;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    //
    use SaveImage;

    // public function classify(Request $request)
    // {
    //     // Instantiate the TensorFlowClass
    //     $tensorflow = new TensorFlowClass();

    //     // Load the model
    //     $tensorflow->loadModel('/App/Http/Controllers/model.tflite');

    //     // Process the image data and get predictions
    //     $imageData = $request->file('image')->get();
    //     $predictions = $tensorflow->classifyImage($imageData);

    //     // Return the predictions as a JSON response
    //     return response()->json(['predictions' => $predictions]);
    // }
    public function index()
    {
        // $post = Post::all();
        // $post = Post::select('id', 'title', 'description', 'status', 'banner', 'shop_id')
        // ->with(['shop' => function ($query) {
        //     $query->withDefault(); // Provide default Shop if not found
        // }])
        // ->orderByDesc('created_at')
        // ->get();

        $post = Post::orderBy('created_at', 'desc')->get();
    

        // dd($post);
        return view('admin.pages.offers.offers.index', compact('post'));
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        // dd($post->toArray());
        $post->delete();
        return redirect()->back();
    }
    public function create_offer_api(Request $request)
    {
        try {
            // dd($request->all());
            $this->validate($request, [
                'banner' => 'required|image|mimes:jpg,bmp,png,webp|max:2048',
                'title' => 'required',
                'description' => 'required',
                // 'hash_tag' => 'required',
                'shop_id' => 'required|array',
                'shop_id.*' => 'exists:shop,id',
                'category_id' => 'required|numeric',
                'subcat_id' => 'array',
                'subcat_id.*' => 'exists:sub_category,id',

                // 'IsFeature' => 'required|In:0,1',
                'area' => 'required|numeric|exists:area,id',
                'multiple_area' => 'array',
            ]);
            if (auth('api')->user()->seller->shop != null) {
                $banner = $this->post_banner($request->banner);
                // // $shop_id = auth('api')->user()->seller->shop->id;
                $data = $request->all();
                $data['banner'] = $banner;
                $data['status'] = 1;
                if($request->has('gender'))
                {
                    $data['gender'] = $request->gender;
                    if($request->gender=="male"){
                        $data['status'] = 1;
                    }
                    else if($request->gender=="female"){
                        $data['status'] = 2;
                    }
                }

                foreach ($request->shop_id as $row) {
                    $data['shop_id'] = $row;
                    // $data['status'] = 2;
                    $offer = Post::create($data);
                    $offer->save();
                    $offer->post_link = 'https://www.pinkad.pk/offer?id='.$offer->id;
                    $offer->save();
                  
                    // 
                    if ($request->has('subcat_id')) {
                        foreach ($request->subcat_id as $item) {
                            $offer_data['offer_id'] = $offer->id;
                            $offer_data['subcat_id'] = $item;
                            OfferSubcatPivot::create($offer_data);
                        }
                    }
                    if ($request->has('multiple_area')) {
                        foreach ($request->multiple_area as $items) {
                            $offer_area['offer_id'] = $offer->id;
                            $offer_area['area_id'] = $items;
                            OfferareaPivot::create($offer_area);
                        }
                    }
                }
                // $fb = new Facebook([
                //     'app_id' => config('app.facebook_app_id'),
                //     'app_secret' => config('app.facebook_app_secret'),
                //     'default_graph_version' => 'v17.0',
                // ]);
                // $pageAccessToken = config('app.facebook_default_access_token');

                // $fb->setDefaultAccessToken($pageAccessToken);
                // $message = 'Your hard-coded message';
                // $response = $fb->post('/pinkad.pk/feed', ['message' => $message]);
                // $graphNode = $response->getGraphNode();
                // dd($graphNode);

                return response()->json(['message' => 'Offer created successfully', 'offer_link' => $offer->post_link]);
            } else {
                return response()->json(['error' => "You've to make the shop first..."]);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()],500);
        }
    }
    public function offer_detail($id)
    {
        // $offer = Post::with('shop', 'shop.seller', 'category', 'subcategory')->where('status', 1)->find($id);
        // return $offer;
        $offer = Post::with('shop', 'shop.seller', 'category', 'subcategory')
             ->where('status', 1)
             ->orderBy('created_at', 'desc') // Order by created_at in descending order
             ->find($id);

        return $offer;

    }
    public function offerList()
    {
        $post = Post::with('shop', 'shop.seller')->where('status', 1)->get();
        return $post;
    }
    public function selleroffer($id)
    {
        $post = Post::with('shop', 'shop.seller')->where('shop_id', $id)->get();
        return $post;
    }
    public function offer_filter(Request $request)
    {
        $post = Post::with('shop', 'shop.seller','subcategory')->where('status', 1);
        if ($request->has('shop_id')) {
            $post = $post->where('shop_id', $request->shop_id);
        }
        if ($request->has('subcat_id')) {
            $subcat = $request->subcat_id;
            $post = $post->whereHas('subcategory',function($query) use($subcat){
                $query->where('subcat_id',$subcat);
            });
        }
        if ($request->has('category_id')) {
            $post = $post->where('category_id', $request->category_id);
        }
        if ($request->has('city_id')) {
            $areas = Area::where('city_id', $request->city_id)->get('id');
            $post = $post->whereIn('area', $areas);
        }
        if ($request->has('area')) {
            $post = $post->where('area', $request->area);
        }
        if ($request->has('title')) {
            $searchString = $request->title;
            $post = $post->where('title', 'like', '%' . $request->title . '%')->orwhereHas('shop', function ($query) use ($searchString) {
                $query->where('name', 'like', '%' . $searchString . '%');
            });
        }
        // $post = $post->OrderBy('id', 'DESC')->get();
        $post = $post->orderByDesc('id')->get();
        return $post;
    }
    public function top_offerList()
    {
        // $post = Post::with('shop', 'shop.seller')->where('status', 1)->OrderBy('id', 'DESC')->paginate(30);
        $post = Post::with('shop', 'shop.seller')->where('status', 1)->OrderBy('id', 'DESC')->get();
        return $post;
    }
    public function featured_offer_list()
    {
        $post = Post::with('shop', 'shop.seller', 'category', 'subcategory')->where('status', 1)
        ->where('IsFeature', 1)->OrderBy('id', 'DESC')->paginate(30);
        return $post;
    }

    public function insights(Request $request)
    {
        try {
            $this->validate($request, [
                'offer_id' => 'required|numeric|exists:post,id',
            ]);
            $offer = Post::find($request->offer_id);
            if ($request->has('views')) {
                $offer->views = $offer->views + 1;
            }
            if ($request->has('impression')) {
                $offer->impression = $offer->impression + 1;
            }
            if ($request->has('reach')) {
                $offer->reach = $offer->reach + 1;
            }
            if ($request->has('conversion')) {
                $offer->conversion = $offer->conversion + 1;
            }
            $offer->save();
            return response()->json(['message' => "updated successfully..."], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function change_status(Request $request)
    {
        try {
            $this->validate($request, [
                'offer_id' => 'required|numeric|exists:post,id',
                'status' => 'required|numeric|In:1,0,2',
            ]);
            $offer = Post::find($request->offer_id);
            if ($request->has('status')) {
                $offer->status = $request->status;
            }

            $offer->save();
            return response()->json(['message' => "updated successfully..."], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
    public function perform_action(Request $request)
    {
        if($request->has('bulk_action'))
        {
            if($request->bulk_action == "delete")
            {
                if($request->has('offers'))
                {
                    foreach($request->offers as $row)
                    {
                        $offer = Post::find($row);
                        $offer->delete();
                    }
                }
            }
            if($request->bulk_action == "promote")
            {
                if($request->has('offers'))
                {
                    foreach($request->offers as $row)
                    {
                        $offer = Post::find($row);
                        $shop = Shop::where('id',$offer['shop_id'])->get();
                        $seller = Seller::where('id', $shop[0]['seller_id'])->get();
                        $area_data=Area::where('id',$shop[0]['area'])->get();
                        $city_id=$area_data[0]['city_id'];
                        $city_data=City::where('id',$city_id)->get();
                        
                        $area_name=$area_data[0]['name'];
                        $city_name=$city_data[0]['name'];
                        $fbk_message = $shop[0]['name']."\r\n". $offer['title']."\r\n". $offer['description']."\r\n";
                        $fbk_message .= "Seller Contact: ". $seller['0']['whatsapp'];

                        $insta_message = $shop[0]['name']."\r\n". $offer['title']."\r\n". $offer['description']."\r\n";
                        $insta_message .= "Seller Contact: ". $seller['0']['whatsapp']; 

                        // SM Integration
                        $long_live_access_token= Http::post('https://graph.facebook.com/oauth/access_token', [
                            'grant_type' => 'fb_exchange_token',
                            'client_id' => '891955272493237',
                            'client_secret' => 'f7d90606830a650135e5a00e9a92cc48',
                            'fb_exchange_token' => 'EAAMrOoUsKLUBO5hggGcTnRdqy350yesPe8zYquYJRTKmlP3qbS3NhWziwK8K4x9ZAQtBZAbwLU72ZAkl8Cv4A986ly1sslt3a4l8OpB3Fzp5jj1I1s8U6nQXMmqWlsEn5KxOh7GCGzDnKhgJfSC19ZB9yy7WR4p68OTAvVjWUCZABlFuFDRpShMKYhQZDZD',
                        ]);
                
                        $access_token=$long_live_access_token['access_token'];

                        $fbk_posting = Http::post('https://graph.facebook.com/v18.0/106430192447842/photos', [
                            'url' =>'https://pinkad.pk/portal/public/storage/'.$offer['banner'],
                            'message' => $fbk_message,
                            'access_token' => $access_token,
                        ]);
                
                        $inst_container = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media', [
                            'image_url' =>'https://pinkad.pk/portal/public/storage/'.$offer['banner'],
                            'caption' => $insta_message,
                            'access_token' => $access_token,
                        ]); 
                        $creation_id=$inst_container['id'];
                
                        $inst_posting = Http::post('https://graph.facebook.com/v18.0/17841459132604500/media_publish', [
                            'creation_id' => $creation_id,
                            'access_token' => $access_token,
                        ]); 
                    }
                }
            }
            if($request->bulk_action == "status-inactive")
            {
                if($request->has('offers'))
                {
                    foreach($request->offers as $row)
                    {
                        $offer = Post::find($row);
                        $offer->status = 0;
                        $offer->save();
                    }
                }
            }
            if($request->bulk_action == "status-active")
            {
                if($request->has('offers'))
                {
                    foreach($request->offers as $row)
                    {
                        $offer = Post::find($row);
                        $offer->status = 1;
                        $offer->save();
                    }
                }
            }
            if($request->bulk_action == "status-reject")
            {
                if($request->has('offers'))
                {
                    foreach($request->offers as $row)
                    {
                        $offer = Post::find($row);
                        $offer->status = 2;
                        $offer->save();
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function filter_offer_status(Request $request){
        $post= null;
        if($request->filter_id=="1"){
            $post = Post::where('status',1)->get();
        }
        else if($request->filter_id=="2"){
            $post = Post::where('status',2)->get();
        }
        else if($request->filter_id=="0"){
            $post = Post::where('status',0)->get();
        }
        else if($request->filter_id=="4"){
            $post = Post::all();       
        }
        return view('admin.pages.offers.offers.index', compact('post'));
    }

//     public function filterpostsbanner(Request $request)
// {
//     $categoryId = $request->input('category_id');
//     $areaId = $request->input('area_id');

// // Check if both category_id and area_id are provided
// if ($categoryId && $areaId) {
//     $filteredPosts = Post::where('category_id', $categoryId)
//                          ->where('area', $areaId)
//                          ->whereNotNull('banner')
//                          ->get();

//     return response()->json(['filtered_banner_posts' => $filteredPosts]);
// } elseif (!$categoryId) {
//     // Category ID not provided, return error
//     return response()->json(['error' => 'Category ID is required.'], 400);
// } elseif (!$areaId) {
//     // Area ID not provided, return error
//     return response()->json(['error' => 'Area ID is required.'], 400);
// }   

// }
public function filterpostsbanner(Request $request)
{
    $category_id = $request->input('category_id');
    $area_id = $request->input('area_id');

    if ($category_id && $area_id) {
        $filteredPosts = Post::whereIn('category_id', $category_id)
                             ->whereIn('area', $area_id)
                             ->where('area', 785)
                             ->whereNotNull('banner')
                             ->get();

        return response()->json(['filtered_banner_posts' => $filteredPosts]);
    } elseif (!$category_id) {
        return response()->json(['error' => 'Category IDs are required.'], 400);
    } elseif (!$area_id) {
        return response()->json(['error' => 'Area IDs are required.'], 400);
    }
}

public function getPostsBySeller(Request $request)
{
    try {
        // Check if seller_id is present in the request
        if (!$request->has('seller_id') || !$request->filled('seller_id')) {
            return response()->json(['error' => 'Please select a seller'], 400);
        }

        $seller_id = $request->seller_id;
        $seller_posts = Post::where('status',1)->whereHas('shop', function ($query) use ($seller_id) {
            $query->where('seller_id', $seller_id);
        })->orderBy('created_at', 'desc')->get();
        

        return response()->json(['seller_posts' => $seller_posts]);
    } catch (\Exception $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
}



}
