<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    //
    protected $guarded = array('id');
    
    //public static $rules = array(
       // 'name' => 'required',
        //'contents' => 'required',
    //);
    
    public function categories()
    {
         return $this->belongsToMany('App\Models\Categoriy');
    }
    
    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    public function getPrefectureNameAttribute() {
        return config('prefecture.'.$this->prefecture_id);
    }
}
