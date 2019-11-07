@extends('layouts.master')

@push('css')
    <link href="{{ secure_asset('css/list.css') }}" rel="stylesheet">
@endpush 

@section('title', '検索記事一覧')

@section('content')
    <div class="coutainer">
        <div class="section-header text-center">
            <h1>おみやげ検索</h1>
            <p>探したい地域を選んでください</p>
        </div>
        <form action="{{ action('PageController@list') }}" method="get">
            <div class="form-group col-md-4 mx-auto">
                {{-- バリデーションエラー文の表示 --}}
                @if(count($errors) > 0)
                 <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                {{-- configから都道府県一覧を取得、検索時選択された値の保持 --}}
                <select class="form-control" name="prefecture_id">
                    <option value="">都道府県名を選択してください</option>
                    @foreach(config('prefecture') as $prefecture_id => $name)
                        <option value="{{ $prefecture_id }}" @if(old('prefecture_id', $prefecture)  == $prefecture_id) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        
        　　{{-- DBからタグを取得、検索時選択された値の保持 --}}
            <div id="tag" class="form-group col-md-8 mx-auto">
                <p>特徴で絞り込み</p>
                <div class="box-line">
                <div class="form-check form-check-inline flex">
                     @foreach($tags as $tag)
                        <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" 
                        @if (!empty(old('tag_id')) && in_array($tag->id, old('tag_id')))
                            checked
                        @else
                            @if(!empty($tag_ids))
                                @foreach($tag_ids as $already_tag)
                                    @if ($tag->id == $already_tag)
                                        checked
                                    @endif
                                @endforeach
                            @endif
                        @endif
                        >
                        <label for="tagname" class="form-check-label">{{ $tag->name }}</label>
                    @endforeach
                </div>
                </div>
            </div> 
            
            {{ csrf_field() }}
            
            <div class="button-wrapper">
                <input type="submit" class="btn btn-primary" value="検索"/>
            </div>
        </form>
    </div>
    
    <div class="coutainer">
        <div class="section-header2 text-center">
            <h1>検索結果</h1>
        </div>
        {{-- foreachで検索結果の記事$pagesを取り出す --}}
        <div class="row">
            <div class="pagelist flex">
                @foreach($pages as $page)
                    <div class="pages">
                        <div class="image">
                            {{-- 画像が登録されていれば最初の1枚目をサムネイルとして表示 --}}
                            @if(!empty($page->images[0]))
                                <a href="{{ action('PageController@detail', ['id' => $page->id]) }}">
                                    <img src="{{ $page->images[0]->path }}" width="300" height="300">
                                    <div class="name p-2">
                                        <p>{{ Str::limit($page->name, 50) }}</p>
                                    </div>
                                </a>
                            {{-- 画像が登録されていなければNoImage画像ををサムネイルとして表示 --}}
                            @else
                                <a href="{{ action('PageController@detail', ['id' => $page->id]) }}">
                                    <img src="{{ asset('images/noimage.jpg') }}" width="300" height="300">
                                    <div class="name p-2">
                                        <p>{{ Str::limit($page->name, 50) }}</p>
                                    </div>
                                </a>
                            @endif
                        </div>
                        {{-- ログイン状態の場合お気に入りボタンを表示 --}}
                        <div class="favorite">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                {{-- お気に入りに登録していないときは登録ボタンを表示 --}}
                                @if(empty(\App\Models\Favorite::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('souvenir_id', $page->id)->first()))
                                    <form id="favorite-form" action="{{ action('Mypage\FavoriteController@store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="souvenir_id" value="{{ $page->id }}">
                                        <input class="favorite-on" type="submit" value="お気に入り登録" />
                                    </form>
                                {{-- お気に入り登録済の場合は解除ボタンを表示 --}}
                                @else
                                    <form id="favorite-form" action="{{ action('Mypage\FavoriteController@destroy') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="souvenir_id" value="{{ $page->id }}">
                                        <input class="favorite-off" type="submit" value="お気に入り解除" />
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- ページネーション：検索条件の値を渡す --}}
        <div class="pagination">
                {{ $pages->appends(['prefecture_id' => $prefecture, 'tag_id' => $tag_ids])->links() }}
        </div>
    </div>
@endsection