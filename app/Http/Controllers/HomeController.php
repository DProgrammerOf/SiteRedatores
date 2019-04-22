<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Trabalho;
use App\Critica;
use App\User;

use Auth;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        return view('home', ['page'=>'home']);
    }

    public function incTexto(){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        return view('texto', ['page'=>'incluir']);
    }

    public function criticar(){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        $Trabalhos = new Trabalho;
        return view('criticar', ['page'=>'criticar', 'trabalhos'=>$Trabalhos->orderBy('created_at', 'DESC')->get()]);
    }

    public function resultados(){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);

        $Trabalhos = Trabalho::where('count_criticas', '>', 0)->orderBy('updated_at', 'DESC')->get();
       /* $Teste = DB::table('criticas')
                        ->join('trabalhos', 'trabalhos.id', '=', 'criticas.trabalho_id')
                        ->orderBy('criticas.updated_at', 'desc')
                        ->get(array(

                                    'trabalhos.id',
                                    'pseudonimo',
                                    'titulo',
                                    'conteudo',
                                    'count_criticas',
                                    'nota',
                                    'texto'


                        ));
        //dd($Teste);
        Outra forma de fazer a listagem (OTIMIZADO)
        */
        $Criticas = Critica::orderBy('created_at', 'DESC')->get();

        //dd($Trabalhos);
        return view('resultados', ['page'=>'resultados', 'trabalhos'=>$Trabalhos, 'criticas'=>$Criticas]);
    }

    public function regulamento(){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        return view('regulamento', ['page'=>'regulamento']);
    }

    public function contato(){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        return view('contato', ['page'=>'contato']);
    }

    public function enviarContato(Request $request){
        $this->validate($request, [
            'email'     => 'required|email',
            'assunto'   =>  'min:3',
            'mensagem'  =>  'min:10']);


        $data = array(
            'email' => $request->email,
            'nome'  =>  Auth::user()->name,
            'assunto' => $request->assunto,
            'bodyMensagem' => $request->mensagem
        );

        Mail::send('email.layout', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('renanvollenghaupt@gmail.com');
            $message->subject($data['assunto']);
        });

        if (Mail::failures()) {
            return redirect()->route('contato')->with('sendEmailError', 'Ocorreu um problema no envio de sua mensagem, tente novamente mais tarde.');
        }
        return redirect()->route('contato')->with('sendEmailOk', 'Sua mensagem foi enviada com sucesso, agradecemos seu contato, aguarde nosso retorno em seu e-mail.');
    }

    public function alerts($title, $page, $headalert, $type){
        if(Auth::user()->status == 0)
            return view('authpass', ['page'=>'authpass']);
        switch ($type) {
            case 10:
                return view('alerts', [$title=>$title,'page'=>$page,'headalert'=>$headalert])
                            ->with('addTextOk', "Seu trabalho foi enviado com sucesso.");
                break;

            case 16:
                return view('alerts', [$title=>$title,'page'=>$page,'headalert'=>$headalert])
                            ->with('addTextError', "Houve um problema no envio de seu trabalho, entre em contato com o administrador.");
                break;
            
            default:
                "nada";
                break;
        }

        //return view('alerts', [$title=>$title,'page'=>$page,'headalert'=>$headalert]);
    }
}
