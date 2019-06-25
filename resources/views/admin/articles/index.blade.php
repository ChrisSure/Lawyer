@extends('admin.layouts.app')

@section('content')

    <div class="card mb-3">
        <div class="card-header">Фільтр</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Ім'я</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="text" class="col-form-label">Текст</label>
                            <input id="text" class="form-control" name="text" value="{{ request('text') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Статус</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Пошук</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Автор</th>
            <th>Ім'я</th>
            <th>Текст</th>
            <th>Статус</th>
            <th>Дата створення</th>
            <th>Дата оновлення</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td><a href="{{ route('admin.users.show', $article->author->id) }}">{{ $article->author->name }}</a></td>
                <td><a href="{{ route('admin.articles.show', $article) }}">{{ $article->name }}</a></td>
                <td>{!! $article->text !!}</td>
                <td>
                    @if ($article->isWait())
                        <span class="badge badge-warning">В очікуванні</span>
                    @endif
                    @if ($article->isActive())
                        <span class="badge badge-success">Активний</span>
                    @endif
                </td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $articles->links() }}
@endsection