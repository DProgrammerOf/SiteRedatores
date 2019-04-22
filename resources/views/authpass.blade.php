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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @elseif(Auth::user()->status == 1)
                        <script type="text/javascript">
                            window.location = "{{ url('/home') }}";
                        </script>
                    @endif

                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ ucfirst(trans($error)) }}</li>
            @endforeach
        </ul>
    </div>
    @endif

                @if(Auth::user()->status == 0)
                    <div class="panel-body">
               {!! Form::open(array('route' => 'attSenha')) !!}

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Digite uma nova senha</label>
                 
                  <div class="input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                    <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
                    <input required type="password" id="password" name="password" class="form-control" placeholder="Nova senha" tabindex="2">
                    <input required type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme nova senha" tabindex="2">
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
                </div>


                

                <button style="width: 40%" type="submit" class="btn btn-success" tabindex="3">Pronto</button>
                {!! Form::close() !!}
            </div>  
            @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
