<?php

namespace App\Http\Controllers;

use App\Models\{Resposta,Pergunta};
use Illuminate\Http\Request;

class RespostaController extends Controller
{

    /**
     * Criar um resposta
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resposta = null; 
        $pergunta = Pergunta::all();  
        return view('pergunta.show')
        ->with(compact('resposta','pergunta'));
    }

    /**
     * Criar um resposta
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request )
    {
        $resposta = new Resposta($request->all());
        $resposta->save();
        return redirect()->route('pergunta.show', ['id'=>$resposta->id_pergunta])
                            ->with('success','resposta cadastrado com sucesso!');
    }
    
    public function removerResposta(int $id_resposta)
    {
        $resposta = Resposta::find($id_resposta);
        $resposta->delete();
        $resposta->save();
        
        return redirect()
                ->back()
                ->with('danger','Removido com sucesso!');
    }
}
