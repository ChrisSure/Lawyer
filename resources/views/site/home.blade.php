@extends('site.layouts.app')

@section('meta')
    <title>Lawyer</title>
    <meta name="description" content="Головна опис">
@endsection

@section('breadcrumbs', '')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Позовна заява про стягнення боргу</h5>
                <div class="card-body">
                    <h5 class="card-title">Про визнання права власності на квартиру за набувальною давністю.</h5>
                    <p class="card-text">Позовна заява – це нормативний документ певної форми, що пред’являється позивачем до суду в установленому законом порядку.</p>
                    <a href="{{ route('state.n1') }}" class="btn btn-primary">Сформувати</a>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Документ</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Сформувати</a>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Позивна заява</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Сформувати</a>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Документ</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Сформувати</a>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Документ</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Сформувати</a>
                </div>
            </div>
        </div>
    </div>
@endsection
