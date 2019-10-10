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
                        <label for="name">商品名</label><span>※必須</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="商品名を入力してください">
                    </div>
    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prefecture">購入場所</label><span>※必須</span>
                            <select class="form-control" name="prefecture_id">
                                <option value="">都道府県名を選択してください</option>
                                @foreach(config('prefecture') as $prefecture_id => $name)
                                    <option value="{{ $prefecture_id }}" @if(old('prefecture_id') ==  $prefecture_id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="categories">カテゴリー</label><span>※必須</span>
                            
                            <select class="form-control" name="category_id">
                                <option value="">選択してください</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id') ==  $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contents">おみやげ詳細</label><span>※必須</span>
                        <textarea class="form-control" name="contents" rows="8">{{ old('contents') }}</textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="quantity">数量</label>
                            <textarea class="form-control" name="quantity" rows="1">{{ old('quantity') }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">価格</label>
                            <textarea class="form-control" name="price" rows="1">{{ old('price') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" class="form-check-input" name="wrapping" value="個別包装">
                            <input type="checkbox" class="form-check-input" name="wrapping" value="個別包装ではない" @if(old('wrapping') == "個別包装ではない") checked @endif>
                            <label for="wrapping" class="form-check-label">個別包装ではない</label>
                        </div>
                        <p class="checkbox-text">※個別包装の時はチェックしないでください</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">画像</label>
                        <input type="file" class="form-control-file" name="image_path1" onchange="imgPreView(event, 'file-preview1')">
                        <div id="file-preview1"></div>
                        <input type="file" class="form-control-file" name="image_path2" onchange="imgPreView(event, 'file-preview2')">
                        <div id="file-preview2"></div>
                        <input type="file" class="form-control-file" name="image_path3" onchange="imgPreView(event, 'file-preview3')">
                        <div id="file-preview3"></div>
                        <input type="file" class="form-control-file" name="image_path4" onchange="imgPreView(event, 'file-preview4')">
                        <div id="file-preview4"></div>
                        <input type="file" class="form-control-file" name="image_path5" onchange="imgPreView(event, 'file-preview5')">
                        <div id="file-preview5"></div>
                    </div>
                    
                    <div class="form-group">
                        <p class="control-label">タグ</p>
                        <div class="form-check form-check-inline">
                            @foreach($tags as $tag)
                                <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" @if(old('tag_id[]') == $tag->id) checked @endif>
                                <label for="tagname" class="form-check-label">{{ $tag->name }}</label>
                            @endforeach
                        </div>
                    </div>
                    
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="投稿する">
                </form>
            </div>
        </div>
    </div>
    
@endsection