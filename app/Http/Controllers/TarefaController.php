<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TarefaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tarefas = Tarefa::where('user_id', auth()->user()->id)->paginate(10);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    public function create(Tarefa $tarefa)
    {
        return view('tarefa.create', ['tarefa' => $tarefa, 'titulo' => 'Adicionar Tarefa']);
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);

        //Mail::to($request->user()->email)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    public function show(Tarefa $tarefa)
    {
        //dd($tarefa->getAttributes());

        return view('tarefa.show',['tarefa' => $tarefa]);
    }

    public function edit(Tarefa $tarefa)
    {
        
        if($tarefa->user_id != auth()->user()->id) return view('acesso-negado');

        return view('tarefa.create', ['tarefa' => $tarefa, 'titulo' => 'Editar Tarefa']);
    }

    public function update(Request $request, Tarefa $tarefa)
    {

        if($tarefa->user_id != auth()->user()->id) return view('acesso-negado');

        $tarefa->update($request->all());
        return redirect()->route('tarefa.index');
    }

    public function destroy(Tarefa $tarefa)
    {

        if($tarefa->user_id != auth()->user()->id) return view('acesso-negado');

        $tarefa->delete();
        
        return redirect()->route('tarefa.index');
    }

    public function exportacao($extensao)
    {
        if(!in_array($extensao,['xlsx','csv', 'pdf'])) throw new \Exception("Extensão não permitida.");

        return Excel::download(new TarefasExport, 'tarefas.'.$extensao);
    }

    public function exportarPDF()
    {
        
        $tarefas = auth()->user()->tarefas()->get();

        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => $tarefas]);

        //tipo de papel: a4, letter...etc
        //orientação: landscape (paisagem), portrait (retrato)
        $pdf->setPaper('a4','landscape');

        //return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    }

}
