<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    //
    protected $guarded = array('id');
    
    
    
    public function categories()
    {
         return $this->belongsToMany('App\Models\Category');
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
