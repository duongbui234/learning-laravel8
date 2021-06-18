<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;



class BrandController extends Controller
{
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
                $req->file('brand_image') ?? 'brand_image' => $upLocation . $imgName,
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
}
