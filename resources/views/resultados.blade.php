@extends('layouts.app')

@section('title')
Resultados - Site Laravel 5.4
@endsection

@section('page')
Resultados
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body" style="padding: 0px;">
                    <div id="validation-errors"></div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" colspan="3" class="text-center">Título</th>
      <th scope="col" width="3em" class="thead-no-dark"></th>
    </tr>
  </thead>
  <tbody>
    @foreach( $trabalhos as $Trabalho )
    @php
    $criticasVisualizadas = App\Http\Controllers\CriticaController::getCountCriticas($Trabalho->id);
    if($criticasVisualizadas < $Trabalho->count_criticas)
      $criticasPendentes = ($Trabalho->count_criticas - $criticasVisualizadas);
    @endphp

    @if($criticasVisualizadas == $Trabalho->count_criticas)
    <tr id="tr-trabalho-{{$Trabalho->id}}" style="background-color: #adadad;" >
      <td colspan="3">{{ $Trabalho->titulo }}
   
       </td>
      <td width="3em"><div class="btn-group">
        
                    <button style="color: #c6c6c6;background-color: #5c5115;border-color: #5d5113;" type="button" id="trabalho-{{$Trabalho->id}}" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$Trabalho->id}}"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Abrir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
    </tr>
    @else
    <tr id="tr-trabalho-{{$Trabalho->id}}" @if($criticasVisualizadas == $Trabalho->count_criticas)
     style="background-color: #adadad;" @endif >
      <td colspan="3">{{ $Trabalho->titulo }}
   
       </td>
      <td width="3em"> <span class="label label-danger" style="position: absolute; z-index: 99;margin-left:0%;">{{ $criticasPendentes }} <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span><div class="btn-group">
        
                    <button type="button" id="trabalho-{{$Trabalho->id}}" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$Trabalho->id}}"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Abrir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
    </tr>
    @endif
     @endforeach
  </tbody>
</table>

 @foreach( $trabalhos as $Trabalho )
<div class="modal fade" id="myModal{{ $Trabalho->id }}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-weight: bold;color: #000;">{{ $Trabalho->titulo }}</h3>
          <span style="font-size: 12px;"><b>Trabalho enviado por <span style="color: #2f6f9f">Renan de Lima Vollenghaupt</span></b></span>
        </div>
        <div class="modal-body">
          @foreach( $criticas as $key => $Critica)
          @if($Critica->trabalho_id == $Trabalho->id)
         <div class="panel panel-warning">
          <div class="panel-heading">Crítica (NOTA: {{$Critica->nota}})</div>
          <div class="panel-body">{{$Critica->texto}}</div>
        </div>
          @endif
          @endforeach
<div class="panel panel-info">
          <div class="panel-heading">Texto analisado</div>
          <div class="panel-body"><div style="border: 1px solid #cfcfcf;  background-color:  rgb(238, 238, 238); padding: 2rem 3rem;">
        <div style="width: 100%;
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
  @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
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


<script>
  
</script>
@foreach( $trabalhos as $Trabalho )
<script>
    $(document).ready(function(){
       $("#trabalho-{{$Trabalho->id}}").on('click', function()
       {  //alert('Titulo do Trabalho ({{$Trabalho->id}}): {{$Trabalho->titulo}}');
            valor = $(this).val();    
            $.ajax({

                type:'POST',
                url:"{!! URL::route('visCritica') !!}",
                dataType: 'JSON',
                data: {
                    "trabalhoid": {{$Trabalho->id}},
                    "countcritica": {{$Trabalho->count_criticas}}
                },
                headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                success:function(data){
                    $("#tr-trabalho-{{$Trabalho->id}}").css('background-color', 'rgb(173, 173, 173)');
                    $("#tr-trabalho-{{$Trabalho->id}} td div button").css('color', '#c6c6c6');
                    $("#tr-trabalho-{{$Trabalho->id}} td div button").css('border-color', '#5d5113');
                    $("#tr-trabalho-{{$Trabalho->id}} td div button").css('background-color', '#5c5115');
                    $("#tr-trabalho-{{$Trabalho->id}} td span").remove();
                },
                error: function (xhr) {
                        console.log((xhr.error));
                    }
            });


       });
    });
</script>
@endforeach
@endsection
