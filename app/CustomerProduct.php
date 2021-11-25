<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class CustomerProduct extends Model
{
    protected $fillable = ['name','status','category_id','brand_id',
        'unit','conditon','location','tags','photos','thumbnail_img','video_provider','video_link',
        'meta_title','meta_description','unit_price','description','pdf'];

    public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $customer_product_translations = $this->hasMany(CustomerProductTranslation::class)->where('lang', $lang)->first();
      return $customer_product_translations != null ? $customer_product_translations->$field : $this->$field;
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class);
    }

    public function subsubcategory(){
    	return $this->belongsTo(SubSubCategory::class);
    }

    public function brand(){
    	return $this->belongsTo(Brand::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function state(){
    	return $this->belongsTo(State::class);
    }

    public function city(){
    	return $this->belongsTo(City::class);
    }

    public function customer_product_translations(){
      return $this->hasMany(CustomerProductTranslation::class);
    }
}
