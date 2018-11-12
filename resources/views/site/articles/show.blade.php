@extends('site.layouts.app')

@section('meta')
    <title>{{ $article->name }}</title>
    <meta name="description" content="{{ $article->description }}">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h1 class="text-center">{{ $article->name }}</h1>
            {!! clean($article->text) !!}
            <p class="text-muted">{{ $article->created_at }}</p>
        </div>

    </div>
@endsection
