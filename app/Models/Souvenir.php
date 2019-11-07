<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    //
    protected $guarded = array('id');
    
    protected $fillable = [
        'user_id', 'prefecture_id', 'name', 'contents', 'wrapping', 'quantity', 'price'
    ];
    
    
    
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
    
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }
    
    public function getPrefectureNameAttribute() {
        return config('prefecture.'.$this->prefecture_id);
    }
}
