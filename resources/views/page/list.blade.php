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
                @if(count($errors) > 0)
                 <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                <select class="form-control" name="prefecture_id">
                    <option value="">都道府県名を選択してください</option>
                    @foreach(config('prefecture') as $prefecture_id => $name)
                        <option value="{{ $prefecture_id }}" @if(old('prefecture_id', $prefecture)  == $prefecture_id) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        
        
            <div class="form-group col-md-7 mx-auto">
                <p>特徴で絞り込み</p>
                <div class="box-line">
                <div class="form-check form-check-inline">
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
        
        <div class="row">
            <div class="pagelist mx-auto">
                @foreach($pages as $page)
                    <div class="pages">
                        <div class="image">
                            @if(!empty($page->images[0]))
                                <a href="{{ action('PageController@detail', ['id' => $page->id]) }}"><img src="{{ $page->images[0]->path }}"  width="300" height="300"></img></a>
                            @else
                                <a href="{{ action('PageController@detail', ['id' => $page->id]) }}"><img src="{{ asset('public/noimage.jpg') }}"></a>
                            @endif
                        </div>
                    
                        <div class="name p-2">
                            <p>{{ Str::limit($page->name, 50) }}</p>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
            
        </div>
    </div>
    
    

@endsection