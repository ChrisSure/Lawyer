@extends('admin.layouts.app')

@section('content')
    <div class="d-flex flex-row mb-3">
        <form method="POST" action="{{ route('admin.logs.destroy') }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Очистити</button>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Рівень</th>
            <th>Опис</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($logs as $log)
            <tr>
                <td>{{ $log->level }}</td>
                <td>{{ $log->header }}</td>
                <td>{{ $log->date }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $logs->links() }}
@endsection