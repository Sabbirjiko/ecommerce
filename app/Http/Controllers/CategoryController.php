<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent_category')->get();
        //dd($categories);exit();
        return view('admin.category.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'category_name' => 'required',
                'parent_id' => 'required',
                'description' => 'nullable',
            ]);

            $data = $request->all();
            $category = new Category;
            $category->name = $data['category_name'];
            $category->slug = str_slug($data['category_name']);
            $category->description = $data['description'];
            $category->parent_id = $data['parent_id'];
            $category->save();
            return redirect()->route('categories')->with('flash_success_message','Category Created Successfully!!');
        }else{
            $parent_category = Category::get();
            return view('admin.category.add',compact('parent_category'));
        }
    }

    public function editCategory(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $category = Category:: find($id);
            $category->name = $data['category_name'];
            $category->slug = str_slug($data['category_name']);
            $category->description = $data['description'];
            $category->parent_id = $data['parent_id'];
            $category->save();
            return redirect()->route('categories')->with('flash_success_message','Category Updated Successfully!!');
        }else{
            $category = Category::whereId($id)->first();
            $parent_category = Category::where('parent_id',0)->get();
            return view('admin.category.edit',compact('category','parent_category'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category:: find($id);
        $category->delete();
        return redirect()->route('categories')->with('flash_success_message','Category Deleted Successfully!!');
    }
}
