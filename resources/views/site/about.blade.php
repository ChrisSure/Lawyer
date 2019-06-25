@extends('site.layouts.app')

@section('meta')
    <title>{{ $page->name }}</title>
    <meta name="description" content="{{ $page->description }}">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h1 class="text-center">Про нас</h1>
            {!! clean($page->text) !!}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h4>Підписатись на новини</h4>
            <form class="form-inline" action="{{ route('about.store') }}" method="post">
                @csrf
                <div class="form-group  mb-2">
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Підписатись</button>
            </form>
        </div>
    </div>
@endsection
