<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Souvenir;
use App\Models\Category;
use App\Models\Tag;

class PageController extends Controller
{
    //ホーム画面
    public function index()
    {
        $tags = Tag::all();
        
        //新着記事取得：最新の3件
        $pages = Souvenir::with(['images', 'tags'])->latest()->take(3)->get();
        
        return view('index', ['tags' => $tags, 'pages' => $pages]);
    }
    
    //検索結果一覧表示
    public function list(Request $request)
    {
        //都道府県とタグのどちらかが選択されていなければエラーとする
        $this->validate($request, [
                'tag_id' => 'required_if:prefecture_id,""',
        ]);
        //タグ一覧表示用の値
        $tags = Tag::all();
        
        //受け取った検索条件の値
        $prefecture = $request->get('prefecture_id');
        $tag_ids = $request->get('tag_id');
        
        //都道府県とタグの両方が選択されている時：10件ずつ表示
        if(!empty($prefecture) && !empty($tag_ids)) {
            $pages = Souvenir::with(['images', 'tags'])
                ->where('prefecture_id', $prefecture)
                ->whereHas('tags', function ($query) use ($tag_ids) {
                    $query->where(function ($query) use ($tag_ids) {
                        foreach ($tag_ids as $tag_id) {
                            $query->orWhere('tags.id', $tag_id);
                        }
                    });
                })->paginate(10);
        //都道府県のみ選択された時：10件ずつ表示
        } elseif(!empty($prefecture) && empty($tag_ids)) {
            $pages = Souvenir::with('images', 'tags')
                ->where('prefecture_id', $prefecture)
                ->paginate(10);
        //タグのみ選択されている時：10件ずつ表示
        } else {
            $pages = Souvenir::with(['images', 'tags'])
                ->whereHas('tags', function ($query) use ($tag_ids) {
                    $query->where(function ($query) use ($tag_ids) {
                        foreach ($tag_ids as $tag_id) {
                            $query->orWhere('tags.id', $tag_id);
                        }
                    });
                })->paginate(10);
        }
        
        return view('page.list', ['tags' => $tags, 'pages' => $pages, 'prefecture' => $prefecture, 'tag_ids' => $tag_ids]);
    }
    
    //記事詳細
    public function detail(Request $request)
    {
        //選択された記事idのデータを取得
        $page = Souvenir::with('categories','images','tags')->find($request->id);
        
        return view('page.detail', ['page' => $page]);
    }
}
