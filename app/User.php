<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'trabalhos_visitados'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function getAddCriticaVisualizada($id, $count){
        if($this->trabalhos_visitados == '')
            $this->trabalhos_visitados = $id.";".$count;
        else
            $this->trabalhos_visitados = $this->trabalhos_visitados."|".$id.";".$count;

        $this->save();
    }

    function attCriticaVisualizada($id, $count){
        $CriticasVisitadas = explode('|', $this->trabalhos_visitados);
        $CriticasVisitadasAtt = '';
            foreach($CriticasVisitadas as $item)
            {
                $CriticasVisitadasSub = explode(';', $item);

                if($CriticasVisitadasSub[0] == $id)
                    $CriticasVisitadasSub[1] = $count;

                if($CriticasVisitadasAtt == '')
                    $CriticasVisitadasAtt = $CriticasVisitadasSub[0].";".$CriticasVisitadasSub[1];
                else
                    $CriticasVisitadasAtt = $CriticasVisitadasAtt."|".$CriticasVisitadasSub[0].";".$CriticasVisitadasSub[1];
            }

        $this->trabalhos_visitados = $CriticasVisitadasAtt;
        $this->save();
    }

    function getCountDeCriticasVisualizadas($id){
        $CriticasVisitadas = explode('|', $this->trabalhos_visitados);
            
            foreach($CriticasVisitadas as $item)
            {
                $CriticasVisitadasSub = explode(';', $item);

                if($CriticasVisitadasSub[0] == $id)
                    return $CriticasVisitadasSub[1];
            }

        return 0;
    }

     function getCountDeCriticasVisualizadasStatic($id){
        $CriticasVisitadas = explode('|', $this->trabalhos_visitados);
            
            foreach($CriticasVisitadas as $item)
            {
                $CriticasVisitadasSub = explode(';', $item);
                
                if($CriticasVisitadasSub[0] == $id)
                    return $CriticasVisitadasSub[1];
            }

        return 0;
    }
}
