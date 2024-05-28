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

    

        public function verifyEmail($email)
        {

            // $encodedEmail = urldecode($email);
            $encodedEmail = $email;

            $user = User::where('email', $encodedEmail)->first();

        
                // Update the user's email_verified_at and updated_at columns
                $user->email_verified_at = now();
                // $user->updated_at = now();
                $user->save();
        
                // Redirect or show success message
                return redirect('https://app.pinkad.pk/email-verified');
           
        }
        

}
