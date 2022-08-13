@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
<main>

  <div class="text-center">
    <h1>BrainQuiz - {{$quiz->titulo}}</h1>                 
     <hr>
  </div> 
  <h1>
    Nova pergunta         
</h1>

{{-- FORMULARIO --}}
    {{-- CADASTRAR --}}
    <form method="POST" action="{{ route('pergunta.store') }}">
        @csrf
      <input type="hidden" name="id_quiz" id="id_quiz" value="{{ $quiz->id_quiz }}">
    

      <div class="row">
      {{-- FORM PERGUNTA --}}
        <div class="col-md-4">        
            <label for="pergunta" class="form-label">Pergunta*</label>
            <input type="text" class="form-control" id="pergunta"
                name="pergunta"
                value=""
                required>
        </div>
        
      {{-- /FORM PERGUNTA --}}


      {{-- DIFICULDADE --}}
        <div class="col-md-2 g-2">
           Dificuldade *
            <select class="form-control" name="id_dificuldade" id="id_dificuldade" required>
                <option value="">Escolha o Nível...</option>
                @foreach ($dificuldade as $item)
                    <option value="{{ $item->id_dificuldade }}">
                        {{ $item->dificuldade }}
                    </option>
                @endforeach
            </select>   
      </div>
    {{-- /DIFICULDADE --}}

    {{-- BOTAO FINAL --}}
    <div class="col-md-2 g-2">
            <button class="btn btn-success mt-4" type="submit">
                <i class="fa-solid fa-circle-plus"></i>
                Adicione uma pergunta
            </button>
        </div>
    {{-- /BOTAO FINAL --}}
    </div>
{{-- FECHA ROW --}}
    
</form>
{{-- /FORMULARIO --}}
<br>
{{-- Lista --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Ações</th>
            <th>Pergunta</th>
            <th>Dificuldade</th>
            <th>Atualizado</th>
        </tr>
    </thead>
<tbody>
    @foreach ($pergunta as $item)
    <tr>
        <td>
            <div class="d-flex flex-column col-sm-6">
                <a class="btn btn-success" href="{{ route('pergunta.show', ['id'=>$item->id_pergunta]) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <button
                    class="btn btn-danger mt-1" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalRemover"
                    data-bs-nomePergunta="{{ $item->pergunta }}"
                    data-bs-url="{{ route('pergunta.removerPergunta', ['idPergunta'=>$item->id_pergunta]) }}"
                    >
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        </td>
        <td>
            {{ $item->pergunta}}
        </td>
        <td>
            @switch($item->id_dificuldade)
                @case(1)
                    <b class="text-success">Fácil</b>
                    @break
                @case(2)
                    <b class="text-warning">Moderado</b>
                    @break
                @case(3)
                    <b class="text-danger">Díficil</b>
                    @break
            @endswitch
        </td>
        <td>
            {{$item->updated_at->format('d/m/Y H:i')}}h
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{-- /Lista --}}
{{-- MODAL REMOVER --}}
<div class="modal fade" id="modalRemover" tabindex="-1" role="dialog" 
  aria-labelledby="modalRemoverLabel" aria-hidden="true">
    <form action="" method="post" id="formRemover">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="col-12">Tem certeza que deseja excluir a pergunta: </p>
                        <p id="pergunta" class=""></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Confirmar exclusão</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- /MODAL REMOVER --}}
</main>
@endsection
@section('script')
@parent
<script>
    const modalRemover = document.getElementById('modalRemover')
    modalRemover.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const nomePergunta = button.getAttribute('data-bs-nomePergunta');
    const url = button.getAttribute('data-bs-url');
    $('#pergunta').text(nomePergunta);
    $('.modal-title').text(nomePergunta);
    $('#formRemover').attr('action', url);
    })
</script>
@endsection