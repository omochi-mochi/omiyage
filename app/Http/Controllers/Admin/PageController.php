<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
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

        
        $page = new Souvenir();
        $page->save();
        $souvenir_id = Souvenir::latest('id')->first();
        
        $tag_ids = $request->get('tag_id');
        $category_id = $request->get('category_id');
        $form = $request->all();
        
        $souvenir_id->tags()->sync($tag_ids);
        $souvenir_id->categories()->sync($category_id);
        
        
        
        
        
        
            $images = $request->get('image_path[]');
            
            $image_ids = [];
            foreach ($images as $file) {
                $image = new Image();
                $path = Storage::disk('s3')->putFile('/',$file,'public');
                $image->path = Storage::disk('s3')->url($path);
                $image->save();
                $image_ids[] = $image->id;
            }
            $souvenir_id->images()->sync($image_ids);
        
        unset($form['_token']);
        unset($form['image_path1'], $form['image_path2'], $form['image_path3'], $form['image_path4'], $form['image_path5']);
        unset($form['category_id']);
        unset($form['tag_id']);
        
        $souvenir_id->fill($form)->save();
        
        
        
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