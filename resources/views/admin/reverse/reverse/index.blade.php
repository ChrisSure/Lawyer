@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Користувач</th>
            <th>Ім'я</th>
            <th>Текст</th>
            <th>Дата створення</th>
            <th>Статус</th>
            <th>Видалення</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($reverses as $reverse)
            <tr>
                <td>{{ $reverse->id }}</td>
                @if($reverse->user_id != null)
                    <td><a href="{{ route('admin.users.show', $reverse->user->id) }}">{{ $reverse->user->name }}</a></td>
                @else
                    <td>Пусто</td>
                @endif
                <td>{{ ($reverse->user_id != null) ? $reverse->user->name : $reverse->name }}</td>
                <td>{{ $reverse->text }}</td>
                <td>{{ $reverse->created_at }}</td>
                <td>
                    @if ($reverse->isUnRead())
                        <a href="{{ route('admin.reverse.verify', $reverse) }}">Помітити як прочитане</a>
                    @endif
                    @if ($reverse->isRead())
                        <span class="badge badge-success">Прочитано</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.reverse.destroy', $reverse) }}" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button class="no-border"><span class="fa fa-trash"></span></button>
                    </form>
                </td>
            </tr>
        @empty
            <p>No reverses</p>
        @endforelse

        </tbody>
    </table>
    {{ $reverses->links() }}
@endsection