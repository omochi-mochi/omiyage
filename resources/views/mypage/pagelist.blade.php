@extends('layouts.master')

@push('css')
    <link href="{{ secure_asset('css/list.css') }}" rel="stylesheet">
@endpush 

@section('title', '投稿記事一覧')

@section('content')
    <div class="coutainer">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="section-header text-center">
                <h2>投稿記事一覧</h2>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="ilst-page col-md mx-auto">
                <div class="row">
                    <table class="page-tb">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="20%">商品名</th>
                                <th width="50%">詳細</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagelists as $pagelist)
                            <tr>
                                <th></th>
                                <td>{{ Str::limit($pagelist->name, 50) }}</td>
                                <td>{{ Str::limit($pagelist->contents, 200) }}</td>
                                <td align=right>
                                    <div>
                                        <a href="{{ action('Admin\PageController@edit', ['id' => $pagelist->id]) }}'" class="btn btn-outline-primary bg-light">編集</a>
                                        
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\PageController@delete', ['id' => $pagelist->id]) }}'" class="btn btn-outline-danger bg-light">削除</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection