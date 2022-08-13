@extends('layouts.base2')
@section('menu')
@endsection
@section('conteudo')

<main>
  <div class=" corcima text-center">
    <h1>BrainQuiz</h1>
    {{-- PUXAR NOME DO QUIS --}}
<hr>
  </div> 

  
{{-- QUIZ  --}}
<div class="container">
    <form action="{{ route('quiz.verificarResposta') }}" method="POST">   
        @csrf       
        <input type="hidden" name="id_quiz" id="id_quiz" value="{{ $quiz->id_quiz }}">
        <input type="hidden" name="id_pergunta" id="id_pergunta" value="{{ $pergunta->id_pergunta }}">
        <div class="col-md-12 text-center">
            <header class="header">
                <h2>{{ $pergunta->pergunta }} </h2><h4> Seus Pontos: <span class="@if(Auth::user()->pontos <= 0) text-danger @else text-success @endif"> {{ Auth::user()->pontos }}</span></h4> 
            </header>
        
            <div class="questao">
            {{-- Repostas --}}
                <div class="resposta">            
                    <div class="form-check text-left">    

                        @php
                            $n = 1
                        @endphp
                        @foreach ($ordem as $indice)
                            <input class="form-check-input" type="radio" name="resposta" id="resposta[{{ $n }}]" value="{{ $indice }}" required>
                            <label class="form-check-label" for="resposta[{{ $n }}]">                   
                                {{ $respostas[$indice] }}
                            </label>
                            <br>
                            @php
                            $n++
                            @endphp
                        @endforeach  

                    </div>
                </div>
                    {{-- Repostas --}}
                </div>
            <div class="row">
                <button type="submit" class="btn btn-success btn-lg col-md-1 offset-md-10 mb-3">Proximo</button>
            </div>
        </div>
    </form>
    {{-- FECHA O COL --}}


 
</div>
{{-- Fecha container e o card do quiz --}}


   


  <p class="copyright">
      &copy; 2022 - <span>T90</span> Todos direitos reservados.
</p>

</div>


    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/perguntas.js') }}" defer></script>
</main>
    @endsection
    
    @section('script')
@parent
@endsection