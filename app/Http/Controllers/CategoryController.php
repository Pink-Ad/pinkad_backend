<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        return view('admin.pages.offers.categories.index',compact('category'));
    }
    public function create()
    {
        return view('admin.pages.offers.categories.create');
    }
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('admin.pages.offers.categories.edit',compact('cat'));
    }
    public function update(Request $request,$id)
    {
        $data = $request->except(['_token','_method']);
        Category::where('id',$id)->update($data);
        return redirect()->route('offer-categories.index');
    }
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('offer-categories.index');
    }
    public function categoryApi()
    {
        $category = Category::where('status',1)->get();
        return $category;
    }
        /// for web
        public function getCategories()
        {
            // dd('asas');
            $categories = Category::all();
            return response()->json($categories);
        }
    
        public function getSubcategories(Request $request, $categoryId)
        {
            $category = Category::findOrFail($categoryId);
            $subcategories = $category->subcategories;
            return response()->json($subcategories);
        }
        // for email verify

    

        public function verifyEmail($email, $token)
        {

          // Decode the email
        $decodedEmail = urldecode($email);

        // Fetch the user by email and token
        $user = User::where('email', $decodedEmail)
                     ->where('remember_token', $token)
                     ->first();

        if ($user) {
            // Update the user's email_verified_at
            $user->email_verified_at = now();
            $user->remember_token = null; // Clear the token
            $user->save();

            // Redirect or show success message
            return redirect('https://app.pinkad.pk/email-verified');
            
        } else {
            return redirect('/')->with('error', 'Invalid verification link.');
        }
    }
               
        

}
