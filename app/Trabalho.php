<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    //
    protected $table = 'trabalhos';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudonimo', 'titulo', 'conteudo', 'id_autor',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'count_criticas',
    ];

    function addTrabalho( $pseudo, $titulo, $texto, $autor ){
    	return $this->create([
    		'pseudonimo' 	=>		$pseudo,
    		'titulo'		=>		$titulo,
    		'conteudo'		=>		$texto,
            'id_autor'      =>      $autor,
    	]);
    }

    function getNmrCriticas(){
        return $this->count_criticas;
    }

    function addCritica(){
        $this->count_criticas =  $this->count_criticas + 1;
        $this->save();

    }

    
}
