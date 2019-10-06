@extends('layouts.master')

@section('title', '新規記事作成')

@section('content')
    <div class="coutainer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                <h2>新規投稿</h2>
                </div>
                
                <form action="{{ action('Admin\PageController@create') }}" method="post" enctype="multipart/form-data">
                    
                    @if(count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group">
                        <lavel for="name">商品名</lavel><span>※必須</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="商品名を入力してください">
                    </div>
    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prefecture">購入場所</label><span>※必須</span>
                            <select class="form-control" name="prefecture_id">
                                <option value="">都道府県名を選択してください</option>
                                @foreach(config('prefecture') as $prefecture_id => $name)
                                    <option value="{{ $prefecture_id }}" @if(old('prefecture_id') == $prefecture_id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="categories">カテゴリー</label><span>※必須</span>
                            <select class="form-control" name="categories_id">
                                <option value="">選択してください</option>
                                <option value="1"></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <lavel for="contents">おみやげ詳細</lavel><span>※必須</span>
                        <textarea class="form-control" name="contents" rows="8">{{ old('contents') }}</textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <lavel for="quantity">数量</lavel>
                            <textarea class="form-control" name="quantity" rows="1">{{ old('quantity') }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <lavel for="price">価格</lavel>
                            <textarea class="form-control" name="qprice" rows="1">{{ old('price') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="wrapping" value="">
                            <input type="hidden" class="form-check-input" name="wrapping" value="">
                            <label for="wrapping" class="form-check-label">個別包装ではない</label>
                        </div>
                        <p class="checkbox-text">※個別包装の時はチェックしないでください</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">画像</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    
                    <div classs="form-group">
                        <label for="tag">タグ</label>
                        
                    </div>
                    
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="投稿する">
                </form>
            </div>
        </div>
    </div>
    
@endsection