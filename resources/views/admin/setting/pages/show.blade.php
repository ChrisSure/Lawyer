@extends('admin.layouts.app')

@section('content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary mr-1">Редагувати</a>

        @if ($page->isWait())
            <form method="POST" action="{{ route('admin.pages.verify', $page) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">Опублікувати</button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.pages.unverify', $page) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">В чорновик</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Видалити</button>
        </form>
    </div>

    <h3>Основні дані</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $page->id }}</td>
        </tr>
        <tr>
            <th>Ім'я</th><td>{{ $page->name }}</td>
        </tr>
        <tr>
            <th>Текст</th><td>{!! clean($page->text) !!}</td>
        </tr>
        <tr>
            <th>Опис</th><td>{{ $page->description }}</td>
        </tr>
        <tr>
            <th>Статус</th>
            <td>
                @if ($page->isWait())
                    <span class="badge badge-warning">Чорновик</span>
                @endif
                @if ($page->isActive())
                    <span class="badge badge-success">Опубліковано</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Дата створення</th><td>{{ $page->created_at }}</td>
        </tr>
        <tr>
            <th>Дата оновлення</th><td>{{ $page->updated_at }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection