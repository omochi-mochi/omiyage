<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Souvenir;
use App\Models\Image;
use App\Models\Tag;
use Storage;
use Carbon\Carbon;



class PageController extends Controller
{
    //
    public function add()
    {
        $user_id = Auth::id();
        $categories = Category::all();
        $tags = Tag::all();

        return view('page.create', ['user_id' => $user_id, 'categories' => $categories, 'tags' => $tags]);
    }
    
    public function create(Request $request)
    {
        
        $this->validate($request, [
                'name' => 'required',
                'prefecture_id' => 'required',
                'category_id' => 'required',
                'contents' => 'required',
            ]);

        $form = $request->all();
        
        $page = new Souvenir();
        $page->fill($form)->save();
        
        $tag_ids = $request->get('tag_id');
        $category_id = $request->get('category_id');
        
        $page->tags()->sync($tag_ids);
        $page->categories()->sync($category_id);
        
        $images = $request->file('image_path');
        $image_ids = [];
        foreach ($images as $file) {
            $image = new Image();
            $path = Storage::disk('s3')->putFile('/',$file,'public');
            $image->path = Storage::disk('s3')->url($path);
            $image->save();
            $image_ids[] = $image->id;
        }
        $page->images()->sync($image_ids);
        
        return redirect('/home');
    }
    
    public function edit(Request $request)
    {
        $user_id = Auth::id();
        $categories = Category::all();
        $tags = Tag::all();
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        
        if(empty($page)) {
            abort(404);
        }
        
        return view('page.edit', ['user_id' => $user_id,'categories' => $categories, 'tags' => $tags, 'page' => $page]);
    }
    
    public function update(Request $request)
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
    
    public function delete(Request $request)
    {
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        
        $page->delete();
        
        return redirect('userpage/pages/');
    }
}