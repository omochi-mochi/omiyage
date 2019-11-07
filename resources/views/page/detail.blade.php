@extends('layouts.master')

@section('title', '記事詳細')

@section('content')

    <div class="coutainer">
        <div class="row">
            {{-- おみやげ名を表示 --}}
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                <h2>{{ $page->name }}</h2>
                </div>
            </div>
        </div>
        {{-- 画像をカルーセルで表示、画像なければNoImage表示 --}}
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if (!empty($page->images[0]))
                        <img class="d-block w-100" src="{{ $page->images[0]->path }}"/>
                    @else
                        <img class="d-block w-100" src="{{ asset('images/noimage.jpg') }}"/>
                    @endif
                </div>
                @if (!empty($page->images[1]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[1]->path }}"/>
                    </div>
                @endif
                @if (!empty($page->images[2]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[2]->path }}"/>
                    </div>
                @endif
                @if (!empty($page->images[3]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[3]->path }}"/>
                    </div>
                @endif
                @if (!empty($page->images[4]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[4]->path }}"/>
                    </div>
                @endif

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">前へ</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">次へ</span>
                </a>
            </div>
        </div>
    </div>
    {{-- 各項目を表示 --}}
    <div class="coutainer">
        <div class="card souvenir-card">
            <div class="card-header">詳細</div>
            <div class="card-body">{{ $page->contents }}</div>
        </div>
        <table class="table contents-table">
            <tbody>
                <tr>
                    <th>購入地</th>
                    <td >{{ $page->PrefectureName }}</td>
                </tr>
                <tr>
                    <th>カテゴリー</th>
                    <td>{{ $page->categories[0]->name }}</td>
                </tr>
                <tr>
                    <th>包装</th>
                    <td>{{ $page->wrapping }}</td>
                </tr>
                <tr>
                    <th>数量</th>
                    <td>{{ $page->quantity }}</td>
                </tr>
                <tr>
                    <th>金額</th>
                    <td>{{ $page->price }}</td>
                </tr>
                <tr>
                    <th>特徴</th>
                    @if (!empty($page->tags))
                        @foreach($page->tags as $tag)
                            <td>{{ $tag->name }}</td>
                        @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    {{-- ログイン状態の場合お気に入りボタンを表示 --}}
    <div class="favorite text-center">
        @if(\Illuminate\Support\Facades\Auth::check())
            {{-- お気に入りに登録していないときは登録ボタンを表示 --}}
            @if(empty(\App\Models\Favorite::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('souvenir_id', $page->id)->first()))
                <form id="favorite-form" action="{{ action('Mypage\FavoriteController@store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="souvenir_id" value="{{ $page->id }}">
                    <input class="favorite-on btn btn-primary" type="submit" value="お気に入り登録" />
                </form>
            {{-- お気に入り登録済の場合は解除ボタンを表示 --}}
            @else
                <form id="favorite-form" action="{{ action('Mypage\FavoriteController@destroy') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="souvenir_id" value="{{ $page->id }}">
                    <input class="favorite-off btn btn-primary" type="submit" value="お気に入り解除" />
                </form>
            @endif
        @endif
    </div>  
@endsection