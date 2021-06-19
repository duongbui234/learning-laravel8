<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;



class BrandController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $req)
    {


        $req->validate([
            'brand_name' => 'required|unique:brands|min:6',
            'brand_image' => 'required|mimes:png,jpg',
        ], [
            'brand_name.required' => 'Please input brand name 🙏🙏🙏'
        ], [
            'brand_name.min' => 'Brand name must be greater than 4 characters 😌😌😌'
        ]);

        $brandImg = $req->file('brand_image');

        $nameGen = hexdec(uniqid());
        $imgExt = strtolower($brandImg->getClientOriginalExtension());
        $imgName = $nameGen . '.' . $imgExt;

        $upLocation = 'image/brand/';

        Image::make($brandImg->getRealPath())->resize(200, 160)->save($upLocation .  $imgName);

        // $nameGen = hexdec(uniqid());
        // $imgExt = strtolower($brandImg->getClientOriginalExtension());
        // $imgName = $nameGen . '.' . $imgExt;
        // $upLocation = 'image/brand/';
        // $brandImg->move($upLocation, $imgName);

        Brand::insert([
            'brand_name' => $req->brand_name,
            'brand_image' => $upLocation . $imgName,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand insert successfully');
    }

    public function editBrand($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }
    public function updateBrand(Request $req, $id)
    {
        $req->validate([
            'brand_name' => 'required|min:6',
            'brand_image' => 'mimes:png,jpg'
        ], [
            'brand_name.required' => 'Please provide brand name 🙏🙏🙏'
        ], [
            'brand_name.min' => 'Brand name must be greater than 6 characters 😅😅😅'
        ]);

        if ($req->file('brand_image')) {

            $oldImg = $req->old_image;

            $newImg = $req->file('brand_image');
            $nameGen = hexdec(uniqid());
            $imgExt = strtolower($newImg->getClientOriginalExtension());
            $imgName = $nameGen . '.' . $imgExt;

            $upLocation = 'image/brand/';

            Image::make($newImg->getRealPath())->resize(200, 160)->save($upLocation . $imgName);

            unlink($oldImg);

            Brand::find($id)->update([
                'brand_name' => $req->brand_name,
                'brand_image' => $upLocation . $imgName,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Updated successfully 👏👏👏');
        } else {

            Brand::find($id)->update([
                'brand_name' => $req->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Updated successfully 👏👏👏');
        }
    }

    public function delBrand($id)
    {
        $brand = Brand::find($id);
        unlink($brand->brand_image);

        Brand::find($id)->delete();

        return Redirect()->back()->with('success', 'Deleted brand successfully');
    }

    public function multiPic()
    {
        $pics = Multipic::all();
        return view('admin.multipic.index', compact('pics'));
    }

    public function storeImg(Request $req)
    {

        // $req->validate([

        //     'image' => 'required',
        // ], [
        //     'image.required' => 'Hmm, please provide image 🙏🙏🙏'
        // ]);

        $images = $req->file('images');

        foreach ($images as $img) {


            $imgName = hexdec(uniqid()) . '.' . strtolower($img->getClientOriginalExtension());
            Image::make($img)->resize(300, 300)->save('image/multi/' . $imgName);

            echo $imgName;

            Multipic::insert([
                'image' => 'image/multi/' . $imgName,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success', 'Inserted successfully');
    }

    public function logOut()
    {
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User logout');
    }
}
