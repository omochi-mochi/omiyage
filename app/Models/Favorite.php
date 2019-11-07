<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $guarded = array('id');
    //タイムスタンプ不要
    public $timestamps = false;
    
    public function souvenirs() 
    {
        return $this->belongsTo('App\Models\Souvenir');
    }
}
