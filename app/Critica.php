<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critica extends Model
{
    //
    protected $table = 'criticas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trabalho_id', 'autor_id', 'nota', 'texto',
    ];

    function addCritica( $trabalho, $autor, $nota, $texto ){
    	return $this->create([
    		'trabalho_id' 	=>		$trabalho,
    		'autor_id'		=>		$autor,
    		'nota'			=>		$nota,
            'texto'      	=>      $texto,
    	]);
    }
}
