@extends('admin.layouts.app')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.pages.create') }}" class="btn btn-success mr-1">Додати сторінку</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Статус</th>
            <th>Дата створення</th>
            <th>Дата оновлення</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td><a href="{{ route('admin.pages.show', $page) }}">{{ $page->name }}</a></td>
                <td>
                    @if ($page->isWait())
                        <span class="badge badge-warning">Чорновик</span>
                    @endif
                    @if ($page->isActive())
                        <span class="badge badge-success">Опубліковано</span>
                    @endif
                </td>
                <td>{{ $page->created_at }}</td>
                <td>{{ $page->updated_at }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $pages->links() }}
@endsection