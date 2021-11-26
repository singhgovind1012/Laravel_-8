<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->Middleware('auth');
    }
    public function AllCat(){
       //$categories = Category::all();
       $categories = Category::latest()->paginate(4);;
      // $categories = DB::table('categories')->latest()->paginate(4);

        // $categories = DB::table('categories')
        //              ->join('users','categories.user_id','users.id') 
        //              ->select('categories.*','users.name')
        //              ->latest()->paginate(4);

        $trashCat = Category::onlyTrashed()->latest()->paginate(2);
        return view('admin.category.index',compact('categories','trashCat'));
    }
    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],[
            'category_name.required' => 'Please Add Categories',
        ]); 

        // Eloquent ORM
        // Category::insert([
        //         'category_name' => $request->category_name,
        //         'user_id' => Auth::user()->id,
        //         'created_at' => Carbon::now()
        // ]);

        $category =new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category-> save();

        //Query Buider ORM 
        // $data =array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories') ->insert($data);

        return Redirect()->back()->with('success','Category inserted Successfull');
    }
    public function Edit($id){
       // $categories_id=Category::find($id);
        $categories_id =DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories_id'));

    }
    public function Update(Request $request,$id){
        // $categories_id=Category::find($id)->update([
        //     'category_name' => $request->category_name, 
        //     'user_id' => Auth::user()->id
        // ]);
            $data =array();
            $data['category_name'] = $request->category_name;
            $data['user_id'] = Auth::user()->id;
            DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('success','Category Updated Successfull');
    
    }
    public function SoftDelete($id)
    {
        $categories_id=Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Delete Successfull');
         
        # code...
    }
    public function Restore($id)
    {
        $categories_id=Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Successfull');
         
        # code...
    }
    public function Pdelete($id)
    {
        $categories_id=Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Parmanently  Deleted');
         
        # code...
    }
}
