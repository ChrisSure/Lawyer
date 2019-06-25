@extends('admin.layouts.app')

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr><th>Назва додатку</th><td>{{ $info['app_name'] }}</td></tr>
            <tr><th>Оточення</th><td>{{ $info['app_env'] }}</td></tr>
            <tr><th>Дебаг-режим</th><td>{{ $info['app_debug'] ? "Включено" : "Виключено"}}</td></tr>
            <tr><th>Базовий url</th><td>{{ $info['app_url'] }}</td></tr>
            <tr><th>Тип бази даних</th><td>{{ $info['app_db'] }}</td></tr>
            <tr><th>Тип зберігання в кеші</th><td>{{ $info['app_cache'] }}</td></tr>
            <tr><th>Тип email</th><td>{{ $info['app_mail'] }}</td></tr>
        </thead>
    </table>
@endsection