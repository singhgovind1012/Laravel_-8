<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }
    public function AddAbout(){
        return view('admin.home.create');
    }
    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title' =>$request->title,
            'short_dis' =>$request->short_dis,
            'long_dis' =>$request->long_dis,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.about')->with('success','About Inserted Successfully');
    }
    public function EditAbout($id)
    {
        # code...
        $homeabout =HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));

    }
    public function UpdateAbout(Request $request,$id)
    {
        # code...
        $update =HomeAbout::find($id)->update([
            'title' =>$request->title,
            'short_dis' =>$request->short_dis,
            'long_dis' =>$request->long_dis,
        ]);
        return Redirect()->route('home.about')->with('success','About Updated Successfully');

    }
    public function DeleteAbout($id)
    {
        # code...
        $delete =HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','About Delete Successfully');

    }
    public function Portfolio()
    {
        # code...
        $images =Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
