@extends('layouts.app')

@section('title')
Incluir Texto - Site Laravel 5.4
@endsection

@section('page')
Incluir Texto
@endsection

@section('content-back')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ ucfirst(trans($error)) }}</li>
            @endforeach
        </ul>
    </div>
    @endif

                    @if (session('addTextOk'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span> &nbsp;{{ session('addTextOk') }}
                        </div>
                    @elseif (session('addTextError'))
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-remove"></span> &nbsp;{{ session('addTextError') }}
                        </div>
                    @endif
                    
                    
    {!! Form::open(array('route' => 'addTexto')) !!}
    <div class="row">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <div class="btn-group"> 
                    <button id="enviarTexto" type="submit" class="btn btn-success" onclick="setInput();" disabled> &nbsp;&nbsp;&nbsp;&nbsp; Enviar  &nbsp;&nbsp;&nbsp;&nbsp;</div></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        

                    <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Pseudônimo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  <input type="text" id="pseudonimo" name="pseudonimo" alt="Pseudônimo" onkeyup="verifCampos();" class="form-control" placeholder="Seu nome pseudônimo." aria-describedby="basic-addon1">
</div>
<br>
   <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Título do Trabalho</span>
  <input type="text" id="titulo" name="titulo" onkeyup="verifCampos();" class="form-control" placeholder="Escreva aqui..." aria-describedby="basic-addon1">
</div>
<br>
 <div class="input-group" style="width: 100%;">
<!-- The toolbar will be rendered in this container. -->
    <div id="toolbar-container"></div>

    <!-- This container will become the editable. -->
    <div id="antes2editor" style="border: 1px solid #cfcfcf;  background-color:  rgb(238, 238, 238); padding: 5rem 10rem;">
        <div id="antes1editor" style="    width: 100%;
    max-width: 100%;
    min-height: 15.7cm;
    margin: 0 auto;
    padding: 2cm 2cm;
    border: 1px #d3d3d3 solid;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0,0,0,.1);">
        <div id="editor" style="box-shadow: none;border: none;min-height: 15.7cm;" onkeyup="verifCampos();">
            <p>This is the initial editor content.</p>
        </div>
        <textarea id="texto" name="texto" hidden="true"></textarea>
    </div>
</div>
            </div>

    <br>
        </div>
    </div>
</div>
</div>
{!! Form::close() !!}
</div>

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script src="{{ asset('js/pt-br.js') }}"></script>
<script>
        DecoupledEditor
            .create( document.querySelector( '#editor' ), {
            language: 'pt-br'
            })
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script>
    function setInput(){
        document.getElementById("texto").innerHTML = document.getElementById("editor").innerHTML;
    }

    function verifCampos(){
        var pseudo = document.getElementById("pseudonimo");
        var titulo = document.getElementById("titulo");
        var textoArt = document.getElementById("editor");
        var buttonSend = document.getElementById("enviarTexto");


        if((pseudo.value != '') && (titulo.value != '') && (textoArt.textContent != '')){
            if(buttonSend.disabled == true)
                buttonSend.disabled = false;
        }else{
            if(buttonSend.disabled == false)
                buttonSend.disabled = true;
        }
    }
</script>

@endsection