@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
<main>
 
    <div class="text-center">
  <h1> <i class="fa-brands fa-product-hunt"></i>
  
    @if ($quiz)
      Editar Quiz Cód.: {{ $quiz->id_quiz }}
    @else
      Novo Quiz 
   @endif        
  </h1>
<hr>
   


{{-- FORMULARIO --}}
@if($quiz)
  {{-- EDITAR --}}
  <form method="POST" action="{{ route('quiz.update',['id'=>$quiz->id_quiz]) }}">
@else 
  {{-- CADASTRAR --}}
  <form method="POST" action="{{ route('quiz.store') }}">
@endif
      @csrf

    <div class="row">
      {{-- NOME DO QUIZ  --}}
      <div class="col-md-3">        
            <label for="titulo" class="form-label">Nome Quiz*</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $quiz ? $quiz->quiz : '' }}" placeholder="Ex: Quiz Futebol" required>
      </div>    
      {{-- NOME DO QUIZ  --}}
    

        {{-- CATEGORIA --}}
        <div class="col-md-2 mt-2">
          Categoria*
            <input type="hidden" name="id_usuario" id="id_usuario" value="{!! $users->id !!}">
              <select class="form-control" name="id_categoria" id="id_categoria" required>
                <option value="">Escolha uma categoria...</option>
                  @foreach ($categorias as $item)
                    <option value="{{ $item->id_categoria }}">
                        {{ $item->categoria }}
                    </option>
                  @endforeach
              </select>
        </div> 
        
      {{-- CATEGORIA --}}

        <div class="col-md-2 mt-4">
            <button class="btn btn-primary" type="submit">
                @if ($quiz)
                    <i class="fa-solid fa-pen-to-square"></i>
                    Atualizar Quiz
                @else
                    <i class="fa-solid fa-floppy-disk"></i>
                    Novo Quiz
                @endif                    
            </button>
        </div>
    </div>

</form>
{{-- /FORMULARIO --}}


<br>
<br>
<br>

  <p class="copyright">
      &copy; 2022 - <span>T90</span> Todos direitos reservados.
</p>
</main>
@endsection
@section('script')
@parent
@endsection