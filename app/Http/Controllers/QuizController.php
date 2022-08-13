<?php

namespace App\Http\Controllers;

use App\Models\{Quiz, Categoria, Dificuldade, Pergunta, PerguntasUsers, Resposta, RespostasUsers, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::orderBy('titulo','asc')->get();        
        return view('quiz.index')
        ->with(compact('quiz'));
    }

    /**
     * Criar um quiz
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quiz = null;        
        $categorias = Categoria::all();
        $users = Auth::user(); 
        return view('quiz.criar')
        ->with(compact('quiz','categorias','users'));
    }
// ,'perguntas','repostas','dificuldade'
    /**
     * Criar um quiz
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request )
    {
        $quiz = new Quiz($request->all());  
        $quiz->save();    
        return redirect()
            ->route('quiz.show', ['id'=>$quiz->id_quiz])
            ->with('success','Quiz cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $quiz = Quiz::find($id);
        $categoria = Categoria::find($id);
        $dificuldade = Dificuldade::all();
        $pergunta = Pergunta::where('id_quiz',$id)->get();
        return view('quiz.show')
            ->with(compact('quiz','categoria','dificuldade','pergunta'));
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
        $quiz = Quiz::find($id);
        // dd($quiz);
        return view('quiz.form')
        ->with(compact('quiz'));
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
        $quiz = Quiz::find($id);
        $quiz->fill($request->all());
        $quiz->save();
        return redirect()->route('quiz.show', ['id'=>$quiz->id_quiz])
        ->with('success','quiz atualizado com sucesso!');
        
    }
    
    public function removerQuiz(int $id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        $quiz->save();
        
        return redirect()
        ->back()
        ->with('danger','Removido com sucesso!');
    }
    
    public function pesquisa(request $pesquisa)
    {
        $quiz = Quiz::where('titulo','like','%'.$pesquisa->pesquisa.'%')->get();
        return view('quiz.pesquisa')
        ->with(compact('quiz')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function play(int $id)
    {
        $id_user = Auth::user()->id;

        $quiz = Quiz::find($id);

        // retira as questoes e respostas erradas dos usuarios
        $repetidas = new PerguntasUsers();
        $repetidas = $repetidas::select('id_pergunta')->where('id_user',$id_user)->get();
        $respostas_repetidas = new RespostasUsers();
        $respostas_repetidas = $respostas_repetidas::select('id_resposta')->where('id_user',$id_user)->get();

        $pergunta = Pergunta::where('id_quiz',$id)
        ->whereNotIn('id_pergunta',$repetidas)
        ->inRandomOrder()
        ->first();

        $restantes = Pergunta::where('id_quiz',$id)
        ->whereNotIn('id_pergunta',$repetidas)
        ->count();

        if ($restantes == 0) {
            $quiz = Quiz::all();
            return redirect()
                ->route('quiz.index')
                ->with('success','Você já finalizou todas as perguntas deste Quiz!');
        }else{

        $respostas_erradas = Resposta::where('id_pergunta',$pergunta->id_pergunta)
            ->where('correto',0)
                ->limit(4)
                    ->whereNotIn('id_resposta',$respostas_repetidas)
                        ->get();
                    
        $resposta_certa = Resposta::where('id_pergunta',$pergunta->id_pergunta)
            ->where('correto',1)
                ->limit(1)
                        ->get();

        //Transforma as duas respostas em array
        $todas =  array_merge($respostas_erradas->toArray(), $resposta_certa->toArray());

        //transformando os indicies nos id_resposta
        foreach ($todas as $resposta) {
            $ordem[] = $resposta['id_resposta'];
            $respostas[$resposta['id_resposta']] = $resposta['resposta'];
        }

        shuffle($ordem);

            return view('quiz.play')
                ->with(compact('quiz','pergunta','respostas','ordem'));
        }

    }

    public function verificarResposta(Request $request)
    {
        $pergunta = Pergunta::find($request->id_pergunta);
        $id_pergunta = $pergunta->id_pergunta;
        $quiz = Quiz::find($request->id_quiz);
        $certa = Resposta::where('id_pergunta',$pergunta->id_pergunta)->where('correto',1)->first();
        if($request->resposta == $certa->id_resposta)
        {
            $user = User::find(Auth::user()->id);
            $user->pontos += 1000;
            $user->save();

            // Cadastra na tabela auxiliar o id_usuario e o id_pergunta
            $perguntasUsers = new PerguntasUsers(Auth::user()->id,$id_pergunta);
            $perguntasUsers->save();         

            return redirect()
                ->route('quiz.playquiz',['id'=>$quiz->id_quiz]);
        }
        else
        {
            $user = User::find(Auth::user()->id);
            $user->pontos -= 250;
            $user->save();

            $respostasUsers = new RespostasUsers(Auth::user()->id,$request->resposta);
            $respostasUsers->save();

            return redirect()
                ->route('quiz.playquiz',['id'=>$quiz->id_quiz]);
        }
    }

    public function rank()
    {
        $users = User::orderby('pontos','desc')->get();
        
        return view('quiz.rank')
            ->with(compact('users'));
    }
}