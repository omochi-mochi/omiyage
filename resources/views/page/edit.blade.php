@extends('layouts.master')

@section('title', '記事編集')

@section('content')
    <div class="coutainer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                <h2>新規投稿</h2>
                </div>
                <form action="{{ action('Admin\PageController@update') }}" method="post" enctype="multipart/form-data">
                    
                    @if(count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group">
                        <label for="name">商品名</label><span>※必須</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $page->name) }}" placeholder="商品名を入力してください">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prefecture">購入場所</label><span>※必須</span>
                            <select class="form-control" name="prefecture_id">
                                <option value="">都道府県名を選択してください</option>
                                @foreach(config('prefecture') as $prefecture_id => $name)
                                    <option value="{{ $prefecture_id }}" @if(old('prefecture_id', $page->prefecture_id) == $prefecture_id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="categories">カテゴリー</label><span>※必須</span>
                            <select class="form-control" name="category_id">
                                <option value="">選択してください</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if(old('category_id', $page->categories[0]->id ) == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contents">おみやげ詳細</label><span>※必須</span>
                        <textarea class="form-control" name="contents" rows="8">{{ old('contents', $page->contents) }}</textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="quantity">数量</label>
                            <textarea class="form-control" name="quantity" rows="1">{{ old('quantity', $page->quantity) }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">価格</label>
                            <textarea class="form-control" name="qprice" rows="1">{{ old('price', $page->price) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" class="form-check-input" name="wrapping" value="個別包装">
                            <input type="checkbox" class="form-check-input" name="wrapping" value="個別包装ではない" @if(old('wrapping', $page->wrapping) == "個別包装ではない") checked @endif>
                            <label for="wrapping" class="form-check-label">個別包装ではない</label>
                        </div>
                        <p class="checkbox-text">※個別包装の時はチェックしないでください</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">画像</label>
                        <input type="file" class="form-control-file" name="image_path[]" onchange="imgPreView(event, 'file-preview1')">
                        <div id="file-preview1">
                        @if (!empty($page->images[0]))
                            <img id="previewImage-file-preview1" src="{{ $page->images[0]->path }}"/>
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $page->images[0]->id }}">削除する
                            @endif
                        </div>
                        <input type="file" class="form-control-file" name="image_path[]" onchange="imgPreView(event, 'file-preview2')">
                        <div id="file-preview2">
                        @if (!empty($page->images[1]))
                            <img id="previewImage-file-preview2" src="{{ $page->images[1]->path }}"/>
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $page->images[1]->id }}">削除する
                            @endif
                        </div>
                        <input type="file" class="form-control-file" name="image_path[]" onchange="imgPreView(event, 'file-preview3')">
                        <div id="file-preview3">
                        @if (!empty($page->images[2]))
                            <img id="previewImage-file-preview3" src="{{ $page->images[2]->path }}"/>
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $page->images[2]->id }}">削除する
                            @endif
                        </div>
                        <input type="file" class="form-control-file" name="image_path[]" onchange="imgPreView(event, 'file-preview4')">
                        <div id="file-preview4">
                        @if (!empty($page->images[3]))
                            <img id="previewImage-file-preview4" src="{{ $page->images[3]->path }}"/>
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $page->images[3]->id }}">削除する
                            @endif
                        </div>
                        <input type="file" class="form-control-file" name="image_path[]" onchange="imgPreView(event, 'file-preview5')">
                        <div id="file-preview5">
                        @if (!empty($page->images[4]))
                            <img id="previewImage-file-preview5" src="{{ $page->images[4]->path }}"/>
                            <input type="checkbox" name="delete_image_ids[]" value="{{ $page->images[4]->id }}">削除する
                            @endif
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <p class="control-label">タグ</p>
                        <div id="tag" class="form-check form-check-inline">
                            @foreach($tags as $tag)
                                <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" 
                                @if (!empty(old('tag_id')) && in_array($tag->id, old('tag_id')))
                                    checked
                                @else
                                    @foreach($page->tags as $already_tag)
                                        @if ($tag->id == $already_tag->id)
                                            checked
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label for="tagname" class="form-check-label">{{ $tag->name }}</label>
                            @endforeach
                        </div>
                        
                    </div>
                    
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="hidden" name="id" value="{{ $page->id }}">
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新する">
                </form>
            </div>
        </div>
    </div>
    
@endsection