<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function homeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function addSlider()
    {
        return view('admin.slider.create');
    }
    public function storeSlider(Request $req)
    {
        $req->validate([
            'image' => 'required|mimes:png,jpg',
        ]);

        $sliderImg = $req->file('image');
        $imgName = hexdec(uniqid()) . '.' . strtolower($sliderImg->getClientOriginalExtension());
        $upLocation = 'image/slider';

        Image::make($sliderImg->getRealPath())->resize(1920, 1080)->save($upLocation .  $imgName);

        Slider::insert([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $upLocation . $imgName,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('slider.all')->with('success', 'Create slider successfully 🚀🚀🚀');
    }
}
