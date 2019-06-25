@extends('site.layouts.app')

@section('meta')
    <title>{{ $page->name }}</title>
    <meta name="description" content="{{ $page->description }}">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h1 class="text-center">Контакти</h1>
            {!! clean($page->text) !!}
        </div>
    </div>
    <div class="row">
        <div class="col">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d389.7050721777163!2d24.710438726214914!3d48.92276917191752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1531221373835" width="1100" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h4>Зворотній зв'язок</h4>
            <form action="{{ route('contacts.store') }}" method="post">
                @csrf
                @guest
                <div class="form-group">
                    <label for="name">Ім'я</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Введіть ім'я">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                @else
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                @endguest
                <div class="form-group">
                    <label for="text">Текст повідомлення</label>
                    <textarea class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" id="text" name="text" rows="4" placeholder="Введіть текст"></textarea>
                    @if ($errors->has('text'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Відправити</button>
            </form>
        </div>
    </div>
@endsection
