@extends('layouts.app')

@section('title')
Painel Controle - Site Laravel 5.4
@endsection

@section('page')
Painel Controle
@endsection

@section('css')
<style type="text/css">
@media screen and (max-width: 550px) {
    .navbar .navbar-default .navbar-static-top {
        width: 550px;
    }

    .container {
        width: 550px;
    }
}
</style>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Trabalhos publicados até o momento</h3></div>

                <div class="panel-body">
                   <table class="table">
                    <thead>
                        <tr>
                          <th scope="col" colspan="3" class="text-center">Titulo do Trabalho</th>
                          <th scope="col" colspan="3" class="text-left">Pseudonimo</th>
                          <th scope="col" colspan="1" class="text-left">Críticas</th>
                          <th scope="col" class="text-center"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $trabalhos as $Trabalho )
                        <tr>
                          <td colspan="3">{{ $Trabalho->titulo }} (ID:{{$Trabalho->id}})</td>
                          <td colspan="3">{{ $Trabalho->pseudonimo }}</td>
                          <td colspan="1">{{ $Trabalho->count_criticas }}</td>
                          <td width="3em"> <div class="btn-group"> 
                                        <button type="button" class="btn btn-primary" onclick="verTrabalho({{$Trabalho->id}})"> &nbsp;&nbsp;&nbsp;&nbsp; Ver tudo  &nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function verTrabalho($id){
        window.location.href = "{!! URL::to('/admin/trabalho/') !!}/"+$id;
}
</script>
@endsection
