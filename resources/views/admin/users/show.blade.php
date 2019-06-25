@extends('admin.layouts.app')

@section('content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Редагувати</a>

        @if ($user->isWait())
            <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="mr-1">
                @csrf
                <button class="btn btn-success">Верифікувати</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Видалити</button>
        </form>
    </div>

    <h3>Основні дані</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Ім'я</th><td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Статус</th>
            <td>
                @if ($user->isWait())
                    <span class="badge badge-warning">В очікуванні</span>
                @endif
                @if ($user->isActive())
                    <span class="badge badge-success">Активний</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Роль</th>
            <td>
                @if ($user->isModerator())
                    <span class="badge badge-danger">Moderator</span>
                @elseif($user->isAdmin())
                    <span class="badge badge-info">Admin</span>
                @elseif($user->isSuperAdmin())
                    <span class="badge badge-success">SuperAdmin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <h3>Профіль</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>Ім'я</th><td>{{ ($user->profile->firstname) ? $user->profile->firstname : "Незаповнено"}}</td>
        </tr>
        <tr>
            <th>Прізвище</th><td>{{ ($user->profile->lastname) ? $user->profile->lastname : "Незаповнено"}}</td>
        </tr>
        <tr>
            <th>По батькові</th><td>{{ ($user->profile->surname) ? $user->profile->surname : "Незаповнено"}}</td>
        </tr>
        <tr>
            <th>Адреса</th><td>{{ ($user->profile->address) ? $user->profile->address : "Незаповнено"}}</td>
        </tr>
        <tr>
            <th>Телефон</th><td>{{ ($user->profile->phone) ? $user->profile->phone : "Незаповнено"}}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <h3>Написані юридичні статті</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        @forelse ($user->articles as $article)
            <tr>
                <td><a href="{{ route('admin.articles.show', $article) }}">{{ $article->name }}</a></td>
            </tr>
        @empty
            <tr>
                <td><p>Пусто</p></td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <h3>Сформовані документи</h3>
    <table class="table table-bordered table-striped">
        <tbody>
        @forelse ($user->states as $state)
            <tr>
                <td><a href="#">{{ $state->id }}</a></td>
            </tr>
        @empty
            <tr>
                <td><p>Пусто</p></td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection