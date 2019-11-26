<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $fillable =['name','slug','description','parent_id','status'];
    public function parent_category(){

        return $this->belongsTo(Category::class,'parent_id');
    }
}
