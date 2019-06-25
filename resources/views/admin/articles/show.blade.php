@extends('admin.layouts.app')

@section('content')

    <div class="d-flex flex-row mb-3">
        @if($article->isWait())
            <form method="POST" action="{{ route('admin.articles.verify', $article) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">Опублікувати</button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.articles.unverify', $article) }}" class="mr-1">
            @csrf
            <button class="btn btn-success">В чернетки</button>
        </form>
        @endif
        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Видалити</button>
        </form>
    </div>

    <h3>Основні дані</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $article->id }}</td>
        </tr>
        <tr>
            <th>Автор</th><td><a href="{{ route('admin.users.show', $article->author->id) }}">{{ $article->author->name }}</a></td>
        </tr>
        <tr>
            <th>Ім'я</th><td>{{ $article->name }}</td>
        </tr>
        <tr>
            <th>Текст</th><td>{!! $article->text !!}</td>
        </tr>
        <tr>
            <th>Статус</th>
            <td>
                @if ($article->isWait())
                    <span class="badge badge-warning">В очікуванні</span>
                @endif
                @if ($article->isActive())
                    <span class="badge badge-success">Активний</span>
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection