<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use Image;
use Session;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index',compact('products')) ;
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
            
            //Upload Image

            if ($request->hasfile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    $product->image = $filename;
                }
               
            }
            //dd($image_tmp);exit();
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
