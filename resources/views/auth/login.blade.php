@extends('layouts.app')

@section('title')
Pagina Inicial - Site Laravel 5.4
@endsection

@section('page')
Pagina Inicial
@endsection

@section('content')
<div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
          
          <div class="panel panel-default box-shadow">
            <div class="panel-heading">
              <span class="text-primary">Painel de Login</span>
              <span class="text-muted pull-right today" title="Today"></span>              
            </div><!--.panel-heading-->

            <div class="panel-body">
               {!! Form::open(array('route' => 'login')) !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
                    <input autofocus required type="email" id="email" name="email" class="form-control" placeholder="Seu email" tabindex="1">

                     
                  </div>
                  @if ($errors->has('email'))
                                    <span class="help-block" style="font-size: 80%;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif  
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Senha   </label>
                 
                  <div class="input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                    <input required type="password" id="password" name="password" class="form-control" placeholder="Sua senha" tabindex="2">

                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
                </div>
                
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-se
                    </label>
                </div>

                <button type="submit" class="btn btn-block btn-primary" tabindex="3">Entrar</button>
                {!! Form::close() !!}
            </div>
          </div><!--.panel-->
        </div><!--.cols-->
      </div><!--.row-->
    </div><!--.container--> 

@endsection
