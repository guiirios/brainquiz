<?php

namespace App\Http\Controllers;

use App\Models\{Pergunta, Resposta, Dificuldade,Quiz};
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    
    {
        // $perguntas = Pergunta::where('id_quiz',$id)->orderBy('pergunta','asc')->get();        
        $pergunta = Pergunta::where('id_quiz',$id)->inRandomOrder()
                                                    ->first();   
        $quiz =  Quiz::find($id)->get();
        return view('pergunta.index')
               ->with(compact('pergunta','quiz'));
    }

    /** 
     * Criar um pergunta
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request )
    {
        $pergunta = new Pergunta($request->all());
        $pergunta->save();

        return redirect()
            ->route('quiz.show',['id'=>$pergunta->id_quiz]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pergunta  $pergunta
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $pergunta = Pergunta::find($id);
        $quiz = Quiz::all();
        $dificuldade = Dificuldade::all();
        $resposta = Resposta::where('id_pergunta',$id)->orderBy('id_resposta','desc')->get();
        // $respostas = Resposta::all();
        return view('pergunta.show')
            ->with(compact('pergunta','quiz','dificuldade','resposta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        // Pesquisar o produto
        $pergunta = Pergunta::find($id);
        // dd($pergunta);
        return view('pergunta.form')
                ->with(compact('pergunta','dificuldade','quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $pergunta = Pergunta::find($id);
        $pergunta->fill($request->all());
        $pergunta->save();
        return redirect()->route('pergunta.show', ['id'=>$pergunta->id_pergunta])
                            ->with('success','pergunta atualizado com sucesso!');

    }
    
    public function removerPergunta(int $id_pergunta)
    {
        $pergunta = Pergunta::find($id_pergunta);
        $pergunta->delete();
        $pergunta->save();
        
        return redirect()
                ->back()
                ->with('danger','Removido com sucesso!');
    }
}
