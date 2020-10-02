@extends('app')
@section('title', 'メニュー')

@section('content')
<div class="container">
    <div>
        <a href="{{ route('api.normal') }}">
            同期実行
        </a>
    </div>
    <div>
        <a href="{{ route('api.promise') }}">
            guzzleの並列実行
        </a>
    </div>
    <div>
        <a href="{{ route('api.swoole') }}">
            swooleで並列実行
        </a>
    </div>
</div>
@endsection