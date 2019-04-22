@extends('layouts.app')

@section('title')
{{ $title }}
@endsection

@section('page')
{{ $page }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $headalert }}</div>

                <div class="panel-body">
                    @if (session('addTextOk'))
                        <div class="alert alert-success">
                            {{ session('addTextOk') }}
                        </div>
                    @elseif (session('addTextError'))
                        <div class="alert alert-danger">
                            {{ session('addTextError') }}
                        </div>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
