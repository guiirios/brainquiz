<?php

namespace App\Http\Controllers;

use App\Models\Dificuldade;
use Illuminate\Http\Request;

class DificuldadeController extends Controller
{
    /**
     * Criar um dificuldade
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dificuldade = null;        
        return view('dificuldade.criar')
        ->with(compact('dificuldade'));
    }

    /**
     * Criar um dificuldade
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request )
    {
        $dificuldade = new Dificuldade($request->all());  
        $dificuldade->save();    
        return redirect()->route('quiz.index')
                            ->with('success','dificuldade cadastrado com sucesso!');
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
        $dificuldade = Dificuldade::find($id);
        // dd($dificuldade);
        return view('dificuldade.form')
                ->with(compact('dificuldade'));
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
        $dificuldade = Dificuldade::find($id);
        $dificuldade->fill($request->all());
        $dificuldade->save();
        return redirect()->route('dificuldade.show', ['id'=>$dificuldade->id_dificuldade])
                            ->with('success','quiz atualizado com sucesso!');

    }
}
