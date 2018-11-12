@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('cabinet.articles.edit', $article) }}" class="btn btn-primary mr-1">Редагувати</a>
                <form method="POST" action="{{ route('cabinet.articles.destroy', $article) }}" class="mr-1">
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
                    <th>Ім'я</th><td>{{ $article->name }}</td>
                </tr>
                <tr>
                    <th>Текст</th><td>{!! clean($article->text) !!}</td>
                </tr>
                <tr>
                    <th>Опис</th><td>{{ $article->description }}</td>
                </tr>
                <tr>
                    <th>Статус</th>
                    <td>
                        @if ($article->isWait())
                            <span class="badge badge-warning">На модерації</span>
                        @endif
                        @if ($article->isActive())
                            <span class="badge badge-success">Активовано</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Дата створення</th><td>{{ $article->created_at }}</td>
                </tr>
                <tr>
                    <th>Дата оновлення</th><td>{{ $article->updated_at }}</td>
                </tr>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection