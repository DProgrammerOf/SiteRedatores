<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabalho;
use App\Critica;
use App\User;

use Auth;

class AdminController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$Trabalhos = Trabalho::orderBy('created_at', 'DESC')->get();
    	return view('admin', ['page'=>'Painel Controle', 'trabalhos'=>$Trabalhos]);
    }

    public static function getUsuario($id){
    	return User::findOrFail($id)->first();
    }

    public function verTrabalho($id){
    	$Trabalhos = Trabalho::where('id',$id)->first();
    	//dd($Trabalhos);
        $Criticas = Critica::where('trabalho_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('admintrabalho', ['page'=>'Painel Controle', 'Trabalho'=>$Trabalhos, 'criticas'=>$Criticas]);
    }
}
