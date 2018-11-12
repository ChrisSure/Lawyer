@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            <h3>Дані профіля для документів</h3>
            <form method="POST" action="{{ route('cabinet.profile.update', $profile) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Ім'я</label>
                    <input id="name" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname', $profile->firstname) }}" >
                    @if ($errors->has('firstname'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('firstname') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Прізвище</label>
                    <input id="name" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname', $profile->lastname) }}" >
                    @if ($errors->has('lastname'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('lastname') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">По-батькові</label>
                    <input id="name" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname', $profile->surname) }}">
                    @if ($errors->has('surname'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('surname') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Адреса</label>
                    <input id="name" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', $profile->address) }}">
                    @if ($errors->has('address'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Телефон</label>
                    <input id="name" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $profile->phone) }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection