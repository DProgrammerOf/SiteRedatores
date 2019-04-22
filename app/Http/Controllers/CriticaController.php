<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Critica;
use App\Trabalho;
use App\User;

use Auth;

class CriticaController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function __construct()
    {
         $this->middleware('auth');
         //$this->middleware('auth', ['except' => ['profile']]);
    }

    public function att(Request $request)
    {
        if($request->all()){
            $UserModel = User::findOrFail(Auth::user()->id);
            $CountVisitadas = $UserModel->getCountDeCriticasVisualizadas($request->trabalhoid);
            if($CountVisitadas > 0){
                $TrabalhoModel = Trabalho::findOrFail($request->trabalhoid);
                //return ["status" => "CountVisitadas: ".$CountVisitadas." | count_criticas: ".$TrabalhoModel->count_criticas];
                if($TrabalhoModel->count_criticas == $CountVisitadas)
                    return ["status" => "Você já visitou todas criticas desse trabalho"];
                else
                    $UserModel->attCriticaVisualizada($request->trabalhoid, $request->countcritica);
                    return ["status" => "Sua visita foi atualizada agora."];
            }else{
                $UserModel->getAddCriticaVisualizada($request->trabalhoid, $request->countcritica);
                 return ["status" => "Sua visita foi criada, esse trabalho nunca foi visto."];
            }   
       }
    }


    public static function getCountCriticas($id){
         $UserModel = User::findOrFail(Auth::user()->id);
         return $UserModel->getCountDeCriticasVisualizadas($id);
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    	if($request->all()){
    		//dd($request);

            $validatedData = $this->validate($request, [
                    'nota'               => 'required|min:1',
                    'analise'            => 'required|min:10',
                ]);

            $trabalho = Trabalho::findOrFail($request->trabalho);
            $critica = new Critica;

            $critica = $critica->addCritica( $request->trabalho, Auth::user()->id, $request->nota, $request->analise );

            if($critica){
                $trabalho->addCritica();
                return redirect()->route('criticar')->with('addCriticaOk', "Sua critica foi enviada com sucesso.");
            }else{
                return redirect()->route('criticar')->with('addCriticaError', "Houve um problema no envio de sua critica, entre em contato com o administrador.");
            }
        }
    }
}
