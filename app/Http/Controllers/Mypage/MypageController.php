<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Souvenir;

class MypageController extends Controller
{
    //
    public function index(Request $request)
    {
        
        $user_name = Auth::user()->name;
        
        return view('mypage.index', ['user_name' => $user_name]);
    }
    
    public function profileEdit(Request $request)
    {
        
        return view('mypage.profileEdit');
    }
    
    public function profileUpdate(Request $request)
    {
        
        return redirect('mypage.index');
    }
    
    public function pagelist(Request $request)
    {
        $pagelists = Souvenir::where('user_id', $request->user()->id)->get();
        
        
        return view('mypage.pagelist', ['pagelists' => $pagelists]);
    }
}
