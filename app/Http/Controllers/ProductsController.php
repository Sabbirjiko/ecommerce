<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        //
    }

    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'product_name' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_code' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'description' => 'nullable',
            ]);

            $data = $request->all();
            $product = new Product;
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->slug = str_slug($data['product_name']);
            $product->description = $data['description'];
            $product->category_id = $data['category_id'];
            $product->price = $data['price'];
            $product->image = $data['image'];
            
            $product->save();
            return redirect()->route('products')->with('flash_success_message','Product Added Successfully!!');
        }else{
            $parent_cat = Category::where('parent_id',0)->get();
            $sub_cat = Category::where('parent_id', '!=' , 0)->get();
            //dd($sub_cat);exit();
            return view('admin.products.add',compact('parent_cat','sub_cat'));
        }
    }

    public function show($id)
    {
        //
    }

    public function editProduct(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
