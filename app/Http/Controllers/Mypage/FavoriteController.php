<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\Souvenir;
use App\Models\Favorite;


class FavoriteController extends Controller
{
    //マイページのお気に入り一覧
    public function list(Request $request) 
    {
        //souvenirsテーブルの中から、リレーション先のfavoritesテーブルのユーザーIDが合致するものを取り出し
        $pages = Souvenir::with(['images'])
            ->whereHas('favorites', function($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })->get();
            
        return view('mypage.favorite_list', ['pages' => $pages]);
    }
    
    //お気に入りの追加
    public function store(Request $request) 
    {
        //フォームデータの受け取り
        $data = $request->all();
        //フォームデータにuser_idはないので追加する
        $data['user_id'] = Auth::user()->id;
        //Favoriteテーブルに保存
        $favorite = new Favorite();
        $favorite->fill($data)->save();
        
        return redirect()->back();
    }
    
    //お気に入りの削除
    public function destroy(Request $request) 
    {
        //FavoriteテーブルからユーザーIDとリクエストの記事IDが合致したIDを取得
        $favorite = Favorite::where('user_id', Auth::user()->id)->where('souvenir_id', $request->get('souvenir_id'))->first();
        
        //削除
        Favorite::destroy($favorite->id);
        
        return redirect()->back();
    }
}
