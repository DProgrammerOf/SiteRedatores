@extends('layouts.app')

@section('title')
Contato - Site Laravel 5.4
@endsection

@section('page')
Contato
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading">Contato</div><br>
                @if (session('sendEmailOk'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span> &nbsp;{{ session('sendEmailOk') }}
                        </div>
                    @elseif (session('sendEmailError'))
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-remove"></span> &nbsp;{{ session('sendEmailError') }}
                        </div>
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
                {!! Form::open(array('route' => 'enviarContato')) !!}
                <div class="panel-body text-center">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" id="email" name="email" alt="Email para retorno" class="form-control" placeholder="Seu nome email para contato." value="{{ Auth::user()->email }}" aria-describedby="basic-addon1">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Assunto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" id="assunto" name="assunto" alt="Assunto" class="form-control" placeholder="Assunto da mensagem..."  aria-describedby="basic-addon1">
                    </div>
                    <br>
                       <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Mensagem</span>
                      <textarea class="form-control" rows="5"  id="mensagem" name="mensagem" placeholder="Escreva aqui sua mensagem..."></textarea>
                    </div>
                    <br>
                    <div class="input-group text-center">
                    <button id="enviarEmail" type="submit" class="btn btn-primary"> &nbsp;&nbsp;&nbsp;&nbsp; Enviar  &nbsp;&nbsp;&nbsp;&nbsp;
                </div></div>
                {!! Form::close() !!}
            </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
