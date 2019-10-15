<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Souvenir;
use App\Models\Category;
use App\Models\Tag;

class PageController extends Controller
{
    //
    public function index()
    {
        $tags = Tag::all();
        
        return view('index', ['tags' => $tags]);
    }
    
    
    public function list(Request $request)
    {
        $this->validate($request, [
                'tag_id' => 'required_if:prefecture_id,""',
        ]);
        
        $tags = Tag::all();
        
        $prefecture = $request->get('prefecture_id');
        $tag_ids = $request->get('tag_id');
        
        
        if(!empty($prefecture) && !empty($tag_ids)) {
            $tags_request = Tag::find($tag_ids);
            $pages = Souvenir::with(['images', 'tags'])->where('prefecture_id', $prefecture)
                ->where(function ($query) use ($tags_request) {
                    foreach($tags_request as $tag) {
                        $query->whereHas('tags', function ($query) use ($tag) {
                            $query->where('tag_id',$tag->id);
                        });
                    }
                })->get();
        } elseif(!empty($prefecture) && empty($tag_ids)) {
            $pages = Souvenir::with('images', 'tags')->where('prefecture_id', $prefecture)->get();
        } else {
            $tag_ids = $request->get('tag_id');
            $tags_request = Tag::find($tag_ids);
            $pages = Souvenir::with(['images','tags'])
                ->where(function ($query) use ($tags_request) {
                    foreach($tags_request as $tag) {
                        $query->whereHas('tags', function ($query) use ($tag) {
                            $query->where('tag_id',$tag->id);
                        });
                    }
                })->get();
        }
        
        return view('page.list', ['tags' => $tags, 'pages' => $pages, 'prefecture' => $prefecture, 'tag_ids' => $tag_ids]);
    }
    
    public function detail(Request $request)
    {
        
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        
        return view('page.detail', ['page' => $page]);
    }
}
