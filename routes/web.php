<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{QuizController,QuizCategoriaController,PerguntaController,DificuldadeController,RespostaController};
// Controllers

// Index
Route::get('/', function () {
    return redirect()->route('quiz.index');
})->middleware(['auth']);

// Pergunta
Route::prefix('perguntas')->middleware(['auth'])->group(function () {

    Route::get('{id}/quizentrar/', [PerguntaController::class, 'index'])
        ->name('pergunta.index');

    Route::post('/cadastrar', [PerguntaController::class, 'store'])
        ->name('pergunta.store');

    Route::post('/{id}/atualizar', [PerguntaController::class,'update'])
        ->name('pergunta.update');

    Route::get('/{id}/ver', [PerguntaController::class, 'show'])
        ->name('pergunta.show');
        
    Route::post('/{idPergunta}/removerPergunta',[PerguntaController::class,'removerPergunta'])
        ->name('pergunta.removerPergunta');
});

// Resposta
Route::prefix('respostas')->middleware(['auth'])->group( function(){

    Route::post('/cadastrar', [RespostaController::class, 'store'])
        ->name('resposta.store');

    Route::post('/{idResposta}/removerResposta',[RespostaController::class,'removerResposta'])
        ->name('resposta.removerResposta');
});

// Quiz
Route::prefix('quiz')->middleware(['auth'])->group(function () {

    Route::get('/', [QuizController::class, 'index'])
        ->name('quiz.index');

    Route::get('/criar', [QuizController::class, 'create'])
        ->name('quiz.create');

    Route::post('/pesquisar', [QuizController::class, 'pesquisa'])
        ->name('quiz.pesquisa');

    Route::post('/cadastrar', [QuizController::class, 'store'])
        ->name('quiz.store');

    Route::get('/{id}/ver', [QuizController::class, 'show'])
        ->name('quiz.show');

    Route::get('/rank', [QuizController::class, 'rank'])
        ->name('quiz.rank');

    Route::post('/{id}/destruir', [QuizController::class, 'removerQuiz'])
        ->name('quiz.removerQuiz');

    Route::get('/{id}/play', [QuizController::class, 'play']) 
        ->name('quiz.playquiz');

    Route::post('/verificarResposta', [QuizController::class, 'verificarResposta']) 
        ->name('quiz.verificarResposta');

});


// Categorias
Route::prefix('categorias')->middleware(['auth'])->group(function () {

    Route::get('/', [QuizCategoriaController::class, 'index'])
        ->name('categoria.index');

    Route::get('/criar', [QuizCategoriaController::class, 'create'])
        ->name('categoria.create');

    Route::post('/cadastrar', [QuizCategoriaController::class, 'store'])
        ->name('categoria.store');

    Route::get('/{id}/editar/', [QuizCategoriaController::class, 'edit'])
        ->name('categoria.edit');

    Route::post('/{id}/alterar', [QuizCategoriaController::class, 'update'])
        ->name('categoria.update');

    Route::get('/{id}/ver', [QuizCategoriaController::class, 'show'])
        ->name('categoria.show');

    Route::post('/{id}/destruir', [QuizCategoriaController::class, 'removerCategoria'])
        ->name('categoria.removerCategoria');

});

require __DIR__.'/auth.php';
