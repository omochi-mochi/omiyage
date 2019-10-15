@extends('layouts.master')

@section('title', '記事詳細')

@section('content')

    <div class="coutainer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                <h2>{{ $page->name }}</h2>
                </div>
            </div>
        </div>
        
        <div id="carouselExampleControls" class="carousel slide mx-auto" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if (!empty($page->images[0]))
                        <img class="d-block w-100" src="{{ $page->images[0]->path }}" width="700" height="500"/>
                    @else
                        <img class="d-block w-100" src="{{ asset('public/noimage.jpg') }}"/>
                    @endif
                </div>
                @if (!empty($page->images[1]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[1]->path }}" width="700" height="500"/>
                    </div>
                @endif
                @if (!empty($page->images[2]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[2]->path }}" width="700" height="500"/>
                    </div>
                @endif
                @if (!empty($page->images[3]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[3]->path }}" width="700" height="500"/>
                    </div>
                @endif
                @if (!empty($page->images[4]))
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $page->images[4]->path }}" width="700" height="500"/>
                    </div>
                @endif
            </div>
        </div>
        
        <a class="carousel-control-prev" href="#carouselOption1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">前へ</span>
        </a>
        <a class="carousel-control-next" href="#carouselOption1" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">次へ</span>
        </a>
    </<div>
    
    <div class="coutainer">
        <div class="card">
            <div class="card-header">詳細</div>
            <div class="card-body">{{ $page->contents }}</div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>購入地</th>
                    <td>{{ $page->prefecture_id }}</td>
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
        

@endsection