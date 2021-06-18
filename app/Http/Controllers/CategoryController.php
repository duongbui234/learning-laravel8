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

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allCat()
    {
        // $categories = DB::table('categories')->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashedList = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashedList'));
    }

    public function addCat(Request $req)
    {
        $req->validate([
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

    public function editCat($id)
    {
        // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function updateCat($id, Request $req)
    {
        // Category::find($id)->update([
        //     'category_name' => $req->category_name,
        //     'user_id' => Auth::user()->id
        // ]);
        DB::table('categories')->where('id', $id)->update([
            'category_name' => $req->category_name,
            'user_id' => AUth::user()->id,
        ]);
        return redirect()->route('all.category')->with('success', 'Category updated successfully 🚀');
    }

    public function softDelete($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category moved to trash list');
    }

    public function restoreCat($id)
    {
        Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category restored successfully');
    }

    public function deleteCat($id)
    {
        Category::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
