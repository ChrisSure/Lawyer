@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            <div class="cabinet-articles">
                <a href="{{ route('cabinet.articles.create') }}" class="btn btn-outline-success mb-3">Написати юридичну статтю</a>
                @foreach($articles as $article)
                    <div class="card">
                        <div class="card-body">
                            <h3><a href="{{ route('cabinet.articles.show', $article) }}">{{ $article->name }}</a></h3>
                            @if ($article->status == 'active')
                                <p><span class="badge badge-success">Опубліковано</span></p>
                            @else
                                <p><span class="badge badge-warning">На модерації</span></p>
                            @endif
                            <span class="text-muted">Дата створення: {{ $article->created_at }}</span>
                        </div>
                    </div>
                @endforeach
                {{ $articles->links() }}

            </div>
        </div>
    </div>
@endsection