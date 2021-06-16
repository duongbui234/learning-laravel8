<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function allCat()
    {
        return view('admin.category.index');
    }
    public function addCat(Request $req)
    {
        $validatedData = $req->validate([
            'category_name' => 'required|unique:categories|max:255'
        ], [
            'category_name.required' => 'Please input category name 🙏🙏🙏'
        ], [
            'category_name.max' => 'Category name must be less than 255 characters 😌😌😌'
        ]);

        Category::insert([
            'category_name' => $req->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        // $category = new Category();
        // $category->category_name = $req->category_name;
        // $category->created_at = Carbon::now();
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // User query builer
        // $data = array();
        // $data['category_name'] = $req->category_name;
        // $data['created_at'] = Carbon::now();
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category inserted successfully');
    }
}
