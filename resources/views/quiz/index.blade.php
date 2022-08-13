@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
<main>
  <div class="text-center">
    <h1>BrainQuiz</h1>
<hr>
</div> 
{{-- CARD --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('danger'))
<div class="alert alert-danger">
    {{ session('danger') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
         @foreach ($quiz as $item)
        

        <div class="card col-md-2">
            <a href="{{ route('quiz.playquiz',['id'=>$item->id_quiz]) }}">
                <div class="card_image mt-3"> 
                    <img src="/img/brainquizcardfoto3.png">  
                </div>
                <div class="card_title title-white mt-2">
                    <p>{{ $item->titulo}}</p>
                </div>
            </a>
            <br><br>
            <br>
            @if(Auth::user()->id == $item->id_usuario or Auth::user()->id == 1)
            <div class="text-center">
                <a class="btn btn-success col-2" href="{{ route('quiz.show', ['id'=>$item->id_quiz]) }}"><i class="bi bi-tools"></i></a>
                <button
                    class="btn btn-danger mt-1"
                    data-bs-toggle="modal"
                    data-bs-target="#modalRemover"
                    data-bs-nomeQuiz="{{ $item->titulo }}"
                    data-bs-url="{{ route('quiz.removerQuiz', ['id'=>$item->id_quiz]) }}">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
            @endif
        </div>

        @endforeach
</div>

{{-- MODAL REMOVER --}}
<div class="modal fade" id="modalRemover" tabindex="-1" role="dialog" aria-labelledby="modalRemoverLabel" aria-hidden="true">
    <form action="" method="post" id="formRemover">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="col-12">Tem certeza que deseja excluir o quiz:</p>
                        <p id="resposta" class=""></p>
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
   


 

   {{-- /CARD --}}


  <p class="copyright">
      &copy; 2022 - <span>T90</span> Todos direitos reservados.
</p>

</div>
</main>
@endsection
@section('script')
    <script>
        const modalRemover = document.getElementById('modalRemover')
        modalRemover.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const nomeResposta = button.getAttribute('data-bs-nomeQuiz');
        const url = button.getAttribute('data-bs-url');
        $('#resposta').text(nomeResposta);
        $('.modal-title').text(nomeResposta);
        $('#formRemover').attr('action', url);
        })
    </script>
@parent
@endsection