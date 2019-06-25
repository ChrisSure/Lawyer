@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.mail.store') }}">
    @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Текст розсилки</label>
            <textarea id="name" rows="4" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" required>
                {{ old('text') }}
            </textarea>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Відправити</button>
        </div>
    </form>
@endsection