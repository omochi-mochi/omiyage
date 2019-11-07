@extends('layouts.master')

@section('title', 'パスワード変更')

@section('content')
    <div class="coutainer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                    <h2>パスワード変更</h2>
                </div>
                
                <form action="{{ action('Mypage\MypageController@profileUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- パスワード照合エラーのフラッシュメッセージがあった場合表示する --}}
                    @if(session('password_error'))
                        <div class="flash_message alert-danger text-center py-3">
                            {{ session('password_error') }}
                        </div>
                    @endif
                    
                    {{-- 成功のフラッシュメッセージを表示する --}}
                    @if(session('password_success'))
                        <div class="flash_message alert-success text-center py-3">
                            {{ session('password_success') }}
                        </div>
                    @endif
                    <div class="card col-md-8 mx-auto">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current">現在のパスワード</label>
                                <input type="password" class="form-control" name="current_password">
                            </div>
                        
                            <div class="form-group">
                                {{-- バリデーションエラー文の表示 --}}
                                @if(count($errors) > 0)
                                    <ul>
                                        @foreach($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            
                                <label for="new">新しいパスワード</label>
                                <input type="password" class="form-control" name="new_password">
                            </div>
                        
                            <div class="form-group">
                                <label for="check">新しいパスワード（確認用）</label>
                                <input type="password" class="form-control" name="new_password_confirmation">
                            </div>
                        
                            <input type="submit" class="btn btn-primary" value="変更する">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection