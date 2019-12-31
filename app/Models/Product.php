<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $fillable = ['product_name','description','image','category_id','slug','product_code','product_color','price'];

    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function attributes(){

        return $this->hasMany(ProductAttribute::class,'product_id','id');
    }
}
