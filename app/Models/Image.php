<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $guarded = array('id');
    
    protected $fillable = ['path'];
    
    public $timestamps = false;
    
    public function souvenirs() 
    {
        return $this->belongsToMany('App\Models\Souvenir');
    }
}
