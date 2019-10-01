<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PageController extends Controller
{
    //
    public function add()
    {
        
        return view('page.create');
    }
    
    public function create()
    {
        return redirect('page/create');
    }
    
    public function edit()
    {
        return view('page.edit');
    }
    
    public function update()
    {
        return redirect('page/edit');
    }
}