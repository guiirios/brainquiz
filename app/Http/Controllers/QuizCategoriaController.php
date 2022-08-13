<?php

namespace App\Http\Controllers;

use App\Models\{Categoria,Quiz};
use Illuminate\Http\Request;

class QuizCategoriaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categoria::orderBy('categoria','asc')->get();        
        return view('categoria.index')
        ->with(compact('categoria'));
    }

    /**
     * Criar um categoria
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = null;        
        return view('categoria.criar')
        ->with(compact('categoria'));
    }

    /**
     * Criar um categoria
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request )
    {
        $categoria = new Categoria($request->all());  
        $categoria->save();    
        return redirect()->route('categoria.index')
                            ->with('success','categoria cadastrado com sucesso!');
    }

    public function show(int $id)
    {
        $quiz = Quiz::where('id_categoria',$id)->get();
        $categoria = Categoria::find($id);
        return view('categoria.show')
            ->with(compact('quiz','categoria'));
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
        $categoria = Categoria::find($id);
        // dd($categoria);
        return view('categoria.criar')
                ->with(compact('categoria'));
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
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->save();
        return redirect()->route('categoria.index');

    }
    
    public function removerCategoria(int $id_categoria)
    {
        $categoria = Categoria::find($id_categoria);
        $categoria->delete();
        $categoria->save();
        
        return redirect()
                ->back()
                ->with('danger','Removido com sucesso!');
    }

    
}
