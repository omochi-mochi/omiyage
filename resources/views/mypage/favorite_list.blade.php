@extends('layouts.master')

@push('css')
    <link href="{{ secure_asset('css/list.css') }}" rel="stylesheet">
@endpush 

@section('title', 'お気に入り記事')

@section('content')
    <div class="coutainer col-md-10">
        <div class="section-header text-center">
            <h1>お気に入り一覧</h1>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection