<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Categoriy;
use App\Models\Souvenir;
use App\Models\Image;
use App\Models\Tag;
use Carbon\Carbon;



class PageController extends Controller
{
    //
    public function add()
    {
        $user_id = Auth::id();
        

        return view('page.create', ['user_id' => $user_id]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
                'name' => 'required',
                'prefecture_id' => 'required',
                'categories' => 'required',
                'contents' => 'required',
            ]);

        
        $page = new Souvenir;
        $form = $request->all();
        
        //image処理
        
        unset($form['_token']);
        //unset($form['_image']);
        
        $page->fill($form);
        $page->save();
        
        
        return redirect('/home');
    }
    
    public function edit(Request $request)
    {
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        
        if(empty($page)) {
            abort(404);
        }
        
        return view('page.edit', ['page' => $page]);
    }
    
    public function update()
    {
        $this->validate($request, [
                'name' => 'required',
                'prefecture_id' => 'required',
                'categories' => 'required',
                'contents' => 'required',
            ]);
        
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        $page = $request->all();
        
        if (isset($news_form['image'])) {
            $path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
            $news->image_path = Storage::disk('s3')->url($path);
            unset($news_form['image']);
        } elseif (isset($request->remove)) {
            $news->image_path = null;
            unset($news_form['remove']);
        }
        
        unset($news_form['_token']);
      
        $news->fill($page)->save();

        return redirect('/home');
    }
}