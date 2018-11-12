@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            <form method="POST" action="{{ route('cabinet.articles.update', $article) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Ім'я</label>
                    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $article->name) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="text" class="col-form-label">Текст</label>
                    <textarea id="text" rows="4" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }} summernote" data-image-url="{{ route('admin.ajax.upload.image') }}" name="text">{{ old('text', $article->text) }}</textarea>
                    @if ($errors->has('text'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Опис</label>
                    <input id="name" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description', $article->description) }}">
                    @if ($errors->has('description'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection