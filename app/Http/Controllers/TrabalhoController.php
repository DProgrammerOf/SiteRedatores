<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabalho;
use Auth;

class TrabalhoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
         //$this->middleware('auth', ['except' => ['profile']]);
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate and store the blog post...
        if($request->all()){

        	//dd($request->all());
               $validatedData = $this->validate($request, [
			        'pseudonimo' 		=> 'required|min:10|max:100',
			        'titulo' 			=> 'required|min:10|max:255',
			        'texto' 		=> 'required|min:10|max:65300',
			    ]);

               $Autor 	= $request->input('pseudonimo');
               $Titulo 	= $request->input('titulo');
               $Texto	= $request->input('texto');

               $Trabalho = new Trabalho;
               if($Trabalho->addTrabalho($Autor, $Titulo, $Texto, Auth::id()))
               		return redirect()->route('incluir')->with('addTextOk', "Seu trabalho foi enviado com sucesso.");
               else
               		return redirect()->route('incluir')->with('addTextError', "Houve um problema no envio de seu trabalho, entre em contato com o administrador.");
        }
    }
}
