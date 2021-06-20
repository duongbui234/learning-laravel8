<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function homeAbout()
    {
        $abouts = HomeAbout::latest()->get();
        return view('admin.home_about.index', compact('abouts'));
    }

    public function storeAbout(Request $req)
    {
        $req->validate([
            'title' => 'required|min:10',
            'short_des' => 'required',
            'long_des' => 'required',
        ]);
        HomeAbout::insert([
            'title' => $req->title,
            'long_des' => $req->long_des,
            'short_des' => $req->short_des,
        ]);
        return Redirect()->route('about.all')->with('success', 'Inserted about successfully');
    }

    public function updateAbout(Request $req, $id)
    {
        $req->validate([
            'title' => 'required|min:10',
        ]);
        HomeAbout::find($id)->update([
            'title' => !$req->title ? $req->old_title : $req->title,
            'short_des' => !$req->short_des ? $req->old_short_des : $req->short_des,
            'long_des' => !$req->long_des ? $req->old_long_des : $req->long_des,
        ]);
        return Redirect()->route('about.all')->with('success', 'updated successfully');
    }
    public function deleteAbout($id)
    {
        HomeAbout::find($id)->delete();
        return Redirect()->route('about.all')->with('success', 'Deleted about successfully');
    }
}
