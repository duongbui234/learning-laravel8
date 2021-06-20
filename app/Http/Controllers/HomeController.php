<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\isEmpty;

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
        $upLocation = 'image/slider/';

        Image::make($sliderImg->getRealPath())->resize(1920, 1080)->save($upLocation .  $imgName);

        Slider::insert([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $upLocation . $imgName,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('slider.all')->with('success', 'Create slider successfully 🚀🚀🚀');
    }

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    public function updateSlider(Request $req, $id)
    {
        $req->validate([
            'image' => 'mimes:png,jpg'
        ]);

        if (!$req->file('image')) {
            Slider::find($id)->update([
                'title' => !$req->title ? $req->old_title : $req->title,
                'description' =>  !$req->description ?  $req->old_description : $req->description,
            ]);
            return Redirect()->route('slider.all')->with('success', 'Update slider successfully ');
        }
        $oldImage = $req->old_image;

        $sliderImg = $req->file('image');
        $imgName = hexdec(uniqid()) . '.' . strtolower($sliderImg->getClientOriginalExtension());
        $upLocation = 'image/slider/';

        Image::make($sliderImg->getRealPath())->resize(1920, 1080)->save($upLocation .  $imgName);

        unlink($oldImage);

        Slider::find($id)->update([
            'title' => !$req->title ? $req->old_title : $req->title,
            'description' =>  !$req->description ?  $req->old_description : $req->description,
            'image' => $upLocation . $imgName
        ]);
        return Redirect()->route('slider.all')->with('success', 'Update slider successfully ');
    }

    public function delSlider($id)
    {
        $slider = Slider::find($id);
        unlink($slider->image);

        Slider::find($id)->delete();

        return Redirect()->back()->with('success', 'Deleted slider successfully 🚀🚀🚀');
    }
}
