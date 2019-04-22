@extends('layouts.app')

@section('title')
Painel Controle - Site Laravel 5.4
@endsection

@section('page')
Painel Controle
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                    @php
                    $donoTrabalho = App\Http\Controllers\AdminController::getUsuario($Trabalho->id_autor);
                    @endphp
                    
                     <div class="panel-heading"><h3 class="modal-title" style="font-weight: bold;color: #000;">{{ $Trabalho->titulo }}</h3>
                     <span style="font-size: 12px;">Trabalho enviado por <span style="color: #2f6f9f">Renan de Lima Vollenghaupt - <b>({{$donoTrabalho->email}})</b></span></span><br>
                     <span style="font-size: 12px">Publicado em: <b>{{$Trabalho->created_at}}</b></span>
                   </div>


                <div class="panel-body">
<div>
    <div>
    
      <!-- Modal content-->
      <div >
        <div>
        </div>
        <div class="modal-body">
          @foreach( $criticas as $key => $Critica)
          @php
          $donoCritica = App\Http\Controllers\AdminController::getUsuario($Critica->autor_id);
          @endphp
          @if($Critica->trabalho_id == $Trabalho->id)
         <div class="panel panel-warning">
          <div class="panel-heading">Crítica <b>(Feita por: {{$donoCritica->email}})</b> | NOTA: {{$Critica->nota}}</div>
          <div class="panel-body">{{$Critica->texto}}</div>
        </div>
          @endif
          @endforeach
<div class="panel panel-info">
          <div class="panel-heading">Texto analisado</div>
          <div class="panel-body"><div style="border: 1px solid #cfcfcf;  background-color:  rgb(238, 238, 238); padding: 2rem 3rem;">
        <div style="    width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0.5cm 0.5cm;
            border: 1px #d3d3d3 solid;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,.1);">
        <div id="editor-{{ $Trabalho->id }}" style="box-shadow: none;border: none;pointer-events: none;" >
            {!! $Trabalho->conteudo !!}
        </div>
    </div>
</div></div>
        </div>

        </div>
      </div>
      
    </div>
  </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
        DecoupledEditor
            .create( document.querySelector( '#editor-{{$Trabalho->id}}' ), {
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
