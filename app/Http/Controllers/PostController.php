<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Area;
use App\Models\OfferSubcatPivot;
use Exception;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use Facebook\Facebook;

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
        $post = Post::all();
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
            ]);
            if (auth('api')->user()->seller->shop != null) {
                $banner = $this->post_banner($request->banner);
                // // $shop_id = auth('api')->user()->seller->shop->id;
                $data = $request->all();
                $data['banner'] = $banner;
                if($request->has('gender'))
                {
                    $data['gender'] = $request->gender;
                }

                foreach ($request->shop_id as $row) {
                    $data['shop_id'] = $row;
                    $data['status'] = 2;
                    $offer = Post::create($data);
                    if ($request->has('subcat_id')) {
                        foreach ($request->subcat_id as $item) {
                            $offer_data['offer_id'] = $offer->id;
                            $offer_data['subcat_id'] = $item;
                            OfferSubcatPivot::create($offer_data);
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

                return response()->json(['message' => "Offer created Successfully..."]);
            } else {
                return response()->json(['error' => "You've to make the shop first..."]);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()],500);
        }
    }
    public function offer_detail($id)
    {
        $offer = Post::with('shop', 'shop.seller', 'category', 'subcategory')->where('status', 1)->find($id);
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
        $post = $post->get();
        return $post;
    }
    public function top_offerList()
    {
        $post = Post::with('shop', 'shop.seller')->where('status', 1)->OrderBy('id', 'DESC')->paginate(10);
        return $post;
    }
    public function featured_offer_list()
    {
        $post = Post::with('shop', 'shop.seller', 'category', 'subcategory')->where('status', 1)->where('IsFeature', 1)->paginate(10);
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
            if($request->bulk_action == "status-active")
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
        }
        return redirect()->back();
    }
}
