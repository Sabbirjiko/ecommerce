<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Image;
use File;
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

    public function editProduct(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $product = Product:: find($id);
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->slug = str_slug($data['product_name']);
            $product->description = $data['description'];
            $product->category_id = $data['category_id'];
            $product->price = $data['price'];

            if ($request->hasfile('image')) {
                $image_tmp = Input::file('image');
                $current_image = $data['current_image'];
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    
                    $image_path = array("images/backend_images/products/small/".$current_image,"images/backend_images/products/large/".$current_image,"images/backend_images/products/medium/".$current_image);
                    foreach ($image_path as $image_loc) {
                        if(File::exists($image_loc)) {
                        File::delete($image_loc);
                        } 
                    }
                    $product->image = $filename;
                }
               
            }

            $product->save();
            return redirect()->route('products')->with('flash_success_message','Product Updated Successfully!!');
        }else{
            $product = Product::whereId($id)->first();
            $parent_cat = Category::where('parent_id',0)->get();
            $sub_cat = Category::where('parent_id', '!=' , 0)->get();
            return view('admin.products.edit',compact('product','parent_cat','sub_cat'));
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
        $product = Product:: find($id);
        $product->delete();
        return redirect()->route('products')->with('flash_success_message','Product Deleted Successfully!!');
    }


//Product Attribute Functions//

    public function ProductAttribute($id)
    {
        $product = Product::with('attributes')->whereId($id)->first();
        //dd($product);exit();
        return view('admin.products.attributes',compact('product'));
    }    

    public function addProductAttribute(Request $request, $id=null)
    {
        $product = Product::with('attributes')->whereId($id)->first();
        //dd($product);exit();
        if ($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);exit();
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect()->back()->with('flash_success_message','Product Attributes Added Successfully!!');
        }else{
            
            return view('admin.products.addAttribute',compact('product'));
        }
    }
    public function deleteProductAttribute($id){
        ProductAttribute::where('id',$id)->delete();
        return redirect()->back()->with('flash_success_message','Product Attributes Deleted Successfully!!');
    }
}
