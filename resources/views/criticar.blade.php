@extends('layouts.app')

@section('title')
Criticar - Site Laravel 5.4
@endsection

@section('page')
Criticar
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body" style="padding: 0px;">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ ucfirst(trans($error)) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                     @if (session('addCriticaOk'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span> &nbsp;{{ session('addCriticaOk') }}
                        </div>
                    @elseif (session('addCriticaError'))
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-remove"></span> &nbsp;{{ session('addCriticaError') }}
                        </div>
                    @endif
                    
                <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" colspan="3" class="text-center">Titulo do Trabalho</th>
      <th scope="col" width="3em" class="thead-no-dark"></th>
    </tr>
  </thead>
  <tbody>
    @foreach( $trabalhos as $Trabalho )
    <tr>
      <td colspan="3">{{ $Trabalho->titulo }} (ID:{{$Trabalho->id}})</td>
      <td width="3em"> <div class="btn-group"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$Trabalho->id}}"> &nbsp;&nbsp;&nbsp;&nbsp; Abrir  &nbsp;&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
    @endforeach
  </tbody>
</table>

 @foreach( $trabalhos as $Trabalho )
 {!! Form::open(array('route' => 'addCritica')) !!}
<div class="modal fade" id="myModal{{ $Trabalho->id }}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-weight: bold;color: #000;">{{ $Trabalho->titulo }}</h3>
          <span style="font-size: 12px;"><b>Autor: {{ $Trabalho->pseudonimo }}</b></span>
        </div>
        <div class="modal-body">
          <div style="border: 1px solid #cfcfcf;  background-color:  rgb(238, 238, 238); padding: 2rem 3rem;">
        <div style="    width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0.5cm 0.5cm;
            border: 1px #d3d3d3 solid;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,.1);">
        <div id="editor-{{$Trabalho->id}}" style="box-shadow: none;border: none;pointer-events: none;" >
            {!! $Trabalho->conteudo !!}
        </div>
    </div>
</div>
<br>
        <div class="input-group">

  <span class="input-group-addon" id="basic-addon1">Análise</span>

  <input required type="text" id="analise" name="analise" class="form-control" placeholder="Escreva aqui..." aria-describedby="basic-addon1">
  <input required type="number" id="nota" name="nota" class="form-control" placeholder="0.00" step="0.01" aria-describedby="basic-addon2">
  <input type="text" name="trabalho" value="{{ $Trabalho->id }}"  hidden="true">
</div>
        </div>
        <div class="modal-footer">
        <div class="btn-group"> 
                    <button id="enviarAnalise" type="submit" class="btn btn-success" > &nbsp;&nbsp;&nbsp;&nbsp; Enviar  &nbsp;&nbsp;&nbsp;&nbsp;</div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
  {!! Form::close() !!}
  @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    function verifCampo(){
        var analise = document.getElementById("analise");
        var analise = document.getElementById("nota");
        var buttonSend = document.getElementById("enviarAnalise");


        if((analise.value != '' && nota.value != '')){
            if(buttonSend.disabled == true)
                buttonSend.disabled = false;
        }else{
            if(buttonSend.disabled == false)
                buttonSend.disabled = true;
        }
    }
</script>
@foreach( $trabalhos as $Trabalho )
<script>
        DecoupledEditor
            .create( document.querySelector( '#editor-{{$Trabalho->id}}' ), {
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endforeach
@endsection
