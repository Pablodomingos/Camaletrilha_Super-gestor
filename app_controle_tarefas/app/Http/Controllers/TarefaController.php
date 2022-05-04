<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Http\Requests\TarefasRequest;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TarefaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::where('user_id', auth()->user()->id)->paginate(10);
        return view('tarefa.index', compact('tarefas'));


        /*
        $id = Auth::user()->id;
        $nome = Auth::user()->name;
        $email = Auth::user()->email;

        return "ID: $id | Name: $nome | E-mail: $email";

        if(Auth::check()) {
            $id = Auth::user()->id;
            $nome = Auth::user()->name;
            $email = Auth::user()->email;

            return "ID: $id | Name: $nome | E-mail: $email";
        } else {
            return 'Você não está autenticado.';
        }

        if(auth()->check()) {
            $id = auth()->user()->id;
            $nome = auth()->user()->name;
            $email = auth()->user()->email;

            return "ID: $id | Name: $nome | E-mail: $email";
        } else {
            return 'Você não está autenticado.';
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarefasRequest $request)
    {
        $dados = $request->all('tarefa', 'data_limite');
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);

        $destinatario = auth()->user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect(route('tarefa.show', ['tarefa' => $tarefa->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show',compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        /*Condição para o usuário mais expertinho
         que tentar alterar alguma tarefa que não o pertence*/
        $user_id = auth()->user()->id;
        if($tarefa->user_id == $user_id) {
            return view('tarefa.edit', compact('tarefa'));
        }

        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(TarefasRequest $request, Tarefa $tarefa)
    {
        $atualizacao = $request->all();

        /*Condição para o usuário mais expertinho
         que tentar alterar alguma tarefa que não o pertence*/
        if(!$tarefa->user_id == auth()->user()->id){
            return view('acesso-negado');
        }

        $tarefa->update($atualizacao);
        return redirect(route('tarefa.show',compact('tarefa')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        if(!$tarefa->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }

        $tarefa->delete();
        return redirect(route('tarefa.index'));
    }

    public function exportacao($tipo_exportacao)
    {
        if(in_array($tipo_exportacao, ['xlsx','csv','pdf']))
        {
            return Excel::download(new TarefasExport, "lista_de_tarefas.$tipo_exportacao");
        }
        return redirect(route('tarefa.index'))->with('success','Formato de arquivo invalido!');
    }

    public function exportarPdfComNovoPacote()
    {
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => $tarefas]);

        $pdf->setPaper('a4', 'landscape');
        //tipo de papel: a4, letter
        //orientação: landscape (paisagem), portrait (retrato)

        return $pdf->stream('lista_de_tarefas.pdf');
        return $pdf->download('lista_de_tarefas.pdf');
    }
}
