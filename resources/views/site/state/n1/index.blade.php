@extends('site.layouts.app')

@section('meta')
    <title>Позовна заява про стягнення боргу</title>
@endsection

@section('content')
    <h1 class="text-center">Позовна заява про стягнення боргу</h1>
    <form method="POST" action="{{ route('state.n1.create') }}">
        @csrf
        <div class="form-group">
            <label for="law" class="col-form-label">Найменування суду</label>
            <input id="law" class="form-control{{ $errors->has('law') ? ' is-invalid' : '' }}" name="law" value="{{ old('law') }}">
            @if ($errors->has('law'))
                <span class="invalid-feedback"><strong>{{ $errors->first('law') }}</strong></span>
            @endif
        </div>

        <hr>

        <h4>Позивач</h4>
        <div class="form-group">
            <label for="p_name" class="col-form-label">Ім'я</label>
            <input id="p_name" class="form-control{{ $errors->has('p_name') ? ' is-invalid' : '' }}" name="p_name" value="{{ old('p_name') }}">
            @if ($errors->has('p_name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('p_name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="p_address" class="col-form-label">Адреса</label>
            <input id="p_address" class="form-control{{ $errors->has('p_address') ? ' is-invalid' : '' }}" name="p_address" value="{{ old('p_address') }}">
            @if ($errors->has('p_address'))
                <span class="invalid-feedback"><strong>{{ $errors->first('p_address') }}</strong></span>
            @endif
        </div>

        <hr>

        <h4>Відповідач</h4>
        <div class="form-group">
            <label for="v_name" class="col-form-label">Ім'я</label>
            <input id="v_name" class="form-control{{ $errors->has('v_name') ? ' is-invalid' : '' }}" name="v_name" value="{{ old('v_name') }}">
            @if ($errors->has('v_name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('v_name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="v_address" class="col-form-label">Адреса</label>
            <input id="v_address" class="form-control{{ $errors->has('v_address') ? ' is-invalid' : '' }}" name="v_address" value="{{ old('v_address') }}">
            @if ($errors->has('v_address'))
                <span class="invalid-feedback"><strong>{{ $errors->first('v_address') }}</strong></span>
            @endif
        </div>

        <hr>

        <div class="form-group">
            <label for="price_claim" class="col-form-label">Ціна позову (грн)</label>
            <input id="price_claim" class="form-control{{ $errors->has('price_claim') ? ' is-invalid' : '' }}" name="price_claim" value="{{ old('price_claim') }}">
            @if ($errors->has('price_claim'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price_claim') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="price_give" class="col-form-label">Сума, яку дав (грн)</label>
            <input id="price_give" class="form-control{{ $errors->has('price_give') ? ' is-invalid' : '' }}" name="price_give" value="{{ old('price_give') }}">
            @if ($errors->has('price_give'))
                <span class="invalid-feedback"><strong>{{ $errors->first('price_give') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="date_give" class="col-form-label">Дата, коли дав борг</label>
            <input id="date_give" type="date" class="form-control{{ $errors->has('date_give') ? ' is-invalid' : '' }}" name="date_give" value="{{ old('date_give') }}">
            @if ($errors->has('date_give'))
                <span class="invalid-feedback"><strong>{{ $errors->first('date_give') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="circum" class="col-form-label">Обставини</label>
            <textarea id="circum" rows="4" class="form-control{{ $errors->has('circum') ? ' is-invalid' : '' }}" name="circum">{{ old('circum') }}</textarea>
            @if ($errors->has('circum'))
                <span class="invalid-feedback"><strong>{{ $errors->first('circum') }}</strong></span>
            @endif
        </div>


        <button type="submit" class="btn btn-success">Сформувати</button>
    </form>
@endsection
