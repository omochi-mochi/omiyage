<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Souvenir;

class MypageController extends Controller
{
    //マイページトップ
    public function index(Request $request)
    {
        //ユーザー名表示用
        $user_name = Auth::user()->name;
        
        return view('mypage.index', ['user_name' => $user_name]);
    }
    
    //パスワード変更入力画面へ
    public function profileEdit(Request $request)
    {
        
        return view('mypage.profile_edit');
    }
    
    //パスワード変更処理
    public function profileUpdate(Request $request)
    {
        //現在のパスワードと違っている場合リダイレクト、エラーのフラッシュメッセージを表示
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->with('password_error', '現在のパスワードが間違っています。');
        }
        
        //現在のパスワードと新しいパスワードが同一の場合リダイレクト、エラーのフラッシュメッセージを表示
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            return redirect()->back()->with('password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }
        
        //バリデーション:新しいパスワードが確認用と一致しているか
        $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
        ]);
        //パスワードをハッシュ化して保存
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        
        return redirect()->back()->with('password_success', 'パスワードを変更しました。');
    }
    
    //投稿記事一覧画面
    public function pagelist(Request $request)
    {
        //souvenirsテーブルから該当ユーザーIDのデータを取り出す
        $pagelists = Souvenir::where('user_id', $request->user()->id)->get();
        
        return view('mypage.pagelist', ['pagelists' => $pagelists]);
    }
}
