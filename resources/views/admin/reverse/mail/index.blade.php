@extends('admin.layouts.app')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.mail.create') }}" class="btn btn-success mr-1">Додати розсилку</a>
        <a href="{{ route('admin.sub.index') }}" class="btn btn-primary mr-1">Список підписників</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Текст розсилки</th>
            <th>Дата створення</th>
            <th>Видалення</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($mails as $mail)
            <tr>
                <td>{{ $mail->id }}</td>
                <td>{{ $mail->text }}</td>
                <td>{{ $mail->created_at }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.mail.destroy', $mail) }}" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button class="no-border"><span class="fa fa-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $mails->links() }}
@endsection