@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            <h3>Дані профіля для документів</h3>
            <form method="POST" action="{{ route('cabinet.main.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Ім'я</label>
                    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" >
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">E-mail</label>
                    <input id="name" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" >
                    @if ($errors->has('email'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection