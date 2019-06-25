@extends('site.layouts.app')

@section('content')
    <div class="row">
        @include('cabinet._nav')
        <div class="col-8">
            @if (!$profile_mes)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>У вас не повністю заповнений профіль ! <a href="{{ route('cabinet.profile') }}">Заповнити</a></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                @if (!$main_mes)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>У вас не повністю заповнені основні дані ! <a href="{{ route('cabinet.main') }}">Заповнити</a></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            <h1 class="text-center">Вітаємо в особистому кабінеті !</h1>
        </div>
    </div>
@endsection