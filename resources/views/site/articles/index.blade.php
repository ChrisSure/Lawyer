@extends('site.layouts.app')

@section('meta')
    <title>Юридичні статті</title>
    <meta name="description" content="Всі юридичні статті">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <form action="{{ route('articles') }}" method="get">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="search" id="formGroupExampleInput" value="{{ request('search') }}" placeholder="Пошук">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
        @foreach($articles as $article)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->name }}</h5>
                        <p class="text-muted">{{ $article->created_at }}</p>
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">Читати</a>
                    </div>
                </div>
        @endforeach
        </div>
    </div>

    {{ $articles->links() }}
@endsection
