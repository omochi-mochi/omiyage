@extends('layouts.master')

@push('css')
    <link href="{{ secure_asset('css/index.css') }}" rel="stylesheet">
@endpush

@section('title', 'マイページ')

@section('content')
    <div class="coutainer">
        <div class="col-md-8 mx-auto">
            <div class="section-header">
                <h2>マイページ</h2>
                <p>ようこそ! {{ $user_name }}さん</p>
            </div>
            
            <div class="section-contents1">
                <div class="section-header">
                    <h3>パスワードの変更</h3>
                </div>
                <button type="button" onclick="location.href='{{ url('userpage/profile/edit') }}'">パスワードを変更する</button>
            </div>
            
            <div class="section-contentslist .row">
                <div class="section-header">
                    <h3>投稿記事編集</h3>
                </div>
                <button type="button" onclick="location.href='{{ url('userpage/pages') }}'">投稿記事一覧へ</button>
            </div>
            
            <div class="section-contentslist .row">
                <div class="section-header">
                    <h3>お気に入り記事編集</h3>
                </div>
                <button type="button" onclick="location.href='{{ url('favorite/list') }}'">お気に入り記事一覧へ</button>
            </div>
            
        </div>
    </div>

@endsection