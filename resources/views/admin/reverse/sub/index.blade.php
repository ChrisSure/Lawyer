@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Дата створення</th>
            <th>Видалення</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($subs as $sub)
            <tr>
                <td>{{ $sub->id }}</td>
                <td>{{ $sub->email }}</td>
                <td>{{ $sub->created_at }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.sub.destroy', $sub) }}" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button class="no-border"><span class="fa fa-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $subs->links() }}
@endsection