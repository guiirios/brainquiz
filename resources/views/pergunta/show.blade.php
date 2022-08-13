@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
<main>
    <div class="text-center">
        <h1>BrainQuiz</h1>
    </div>

  <hr>

  <h3>Editar pergunta : {{$pergunta->pergunta}}</h3>

<br>

<form method="POST" action="{{ route('pergunta.update',['id'=>$pergunta->id_pergunta]) }}">
    @csrf
    <div class="row">
        <div class="col-md-4">        
            <label for="pergunta" class="form-label">Pergunta*</label>
            <input type="text" class="form-control" id="pergunta" name="pergunta" value="{{ $pergunta ? $pergunta->pergunta : '' }}">
        </div>
        <div class="col-md-2 mt-2">
            <br>
            <button class="btn btn-success" type="submit"><i class="fa-solid fa-pen-to-square"></i>Atualizar Pergunta</button>
        </div>
    </div>
</form>

<br>

  <h3><i class="fa-brands fa-product-hunt"></i>Nova resposta</h3>

<br>

{{-- FORMULARIO --}}

    {{-- CADASTRAR --}}
<form method="POST" action="{{ route('resposta.store') }}">
    @csrf
    <input type="hidden" name="id_pergunta" id="id_pergunta" value="{{ $pergunta->id_pergunta }}">

    <div class="row g-3">
        
        <div class="col-md-4">        
            <label for="resposta" class="form-label">Resposta*</label>
            <input type="text" class="form-control" id="resposta" name="resposta" value="">
        </div>

        @if ($resposta->where('correto',1)->count() == 0)

            <div class="col-md-1">
                <label for="correto" class="form-label">Resposta:</label>
                <select name="correto" id="correto" class="form-control">
                    <option value="0">Errado X</option>
                    <option value="1">Certo V</option>
                </select>
            </div>
            
        @else
            <input type="hidden" name="correto" id="correto" value="0">
        @endif

        <div class="col-md-2 mt-4">
            <br>
            <button class="btn btn-primary" type="submit">Adicionar resposta</button>
        </div>

    </div>

</form>
{{-- /FORMULARIO --}}

{{-- Lista --}}
<br>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Ações</th>
            <th>Resposta</th>
            <th>Certo ou errado</th>
            <th>Atualizado</th>
        </tr>
    </thead>
<tbody>
    @foreach ($resposta as $item)
    <tr>
        <td>
            <div class="d-flex flex-column col-sm-4">
                <button
                    class="btn btn-danger mt-1"
                    data-bs-toggle="modal"
                    data-bs-target="#modalRemover"
                    data-bs-nomeResposta="{{ $item->resposta }}"
                    data-bs-url="{{ route('resposta.removerResposta', ['idResposta'=>$item->id_resposta]) }}"
                    >
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        </td>
        <td>
            {{ $item->resposta}}
        </td>
        <td>
            @if ($item->correto == 0)
                <b class="text-danger">Errado</b>
            @else
                <b class="text-success">Correto</b>
            @endif
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
                        <p class="col-12">Tem certeza que deseja excluir a resposta:</p>
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
</main>
@endsection
@section('script')
@parent
<script>
    const modalRemover = document.getElementById('modalRemover')
    modalRemover.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const nomeResposta = button.getAttribute('data-bs-nomeResposta');
    const url = button.getAttribute('data-bs-url');
    $('#resposta').text(nomeResposta);
    $('.modal-title').text(nomeResposta);
    $('#formRemover').attr('action', url);
    })
</script>
@endsection