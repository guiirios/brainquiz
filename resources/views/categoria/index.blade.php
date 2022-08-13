@extends('layouts.base2')
@section('menu')
@endsection
@section('conteudo')
<main>
  <div class="text-center">
    <h1>Todas Categorias:</h1>
<hr>
</div>
    {{-- CARD --}}
    <div class="row">       
    @foreach ($categoria as $item)        
        <a href="{{ route('categoria.show', ['id'=>$item->id_categoria]) }}">
            <div class="card col-md-2">
                <div class="card_title title-white">
                    <p class="mt-2">{{ $item->categoria }}</p>
                </div>
                @if(Auth::user()->id == 1)
                    <div class="text-center">
                        <a class="btn btn-success col-2" href="{{ route('categoria.edit', ['id'=>$item->id_categoria]) }}"><i class="bi bi-tools"></i></a>
                        <button
                        class="btn btn-danger mt-1"
                        data-bs-toggle="modal"
                        data-bs-target="#modalRemover"
                        data-bs-nomeCategoria="{{ $item->titulo }}"
                        data-bs-url="{{ route('categoria.removerCategoria', ['id'=>$item->id_categoria]) }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    </div>
                @endif
            </div>
        </a>
    @endforeach

    </div>
    
   {{-- /CARD --}}

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
                        <p class="col-12">Tem certeza que deseja excluir a categoria:</p>
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


  <p class="copyright">
      &copy; 2022 - <span>T90</span> Todos direitos reservados.
</p>
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