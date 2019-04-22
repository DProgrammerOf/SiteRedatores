@extends('layouts.app')

@section('title')
Home - Site Laravel 5.4
@endsection

@section('page')
Home
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <img src="{{ asset('imagens/logo.png') }}" width=300 height=300 alt="Logomarca">
        </div>
       
    </div>
</div>
@endsection
