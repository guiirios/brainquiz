@extends('layouts.base')
@section('menu')
@endsection
@section('conteudo')
<main>

<h1>
    <i class="fa-brands fa-product-hunt"></i>
    @if ($categoria)
        Editar categoria Cód.: {{ $categoria->id_categoria }}
    @else
        Nova Categoria 
    @endif        
</h1>
  
  {{-- FORMULARIO --}}
  @if($categoria)
    {{-- EDITAR --}}
    <form method="POST" action="{{ route('categoria.update',['id'=>$categoria->id_categoria]) }}">
  @else 
    {{-- CADASTRAR --}}
    <form method="POST" action="{{ route('categoria.store') }}">
  @endif
        @csrf
  
        <br>
    <div class="row g-3">
        <div class="col-md-4">        
            <label for="categoria" class="form-label">Nome da Categoria*</label>
            <input type="text" class="form-control" id="categoria"
                name="categoria"
                value="{{ $categoria ? $categoria->categoria : '' }}"                    
                placeholder="Nome da Categoria"
                required 
                >
        </div>
        <div class="col-md-2 mt-5">
            <button class="btn btn-primary" type="submit">
                @if ($categoria)
                    <i class="fa-solid fa-pen-to-square"></i>
                    Atualizar categoria
                @else
                    <i class="fa-solid fa-floppy-disk"></i>
                    Nova Categoria
                @endif                    
            </button>
        </div>
    </div>
    
  </form>
  {{-- /FORMULARIO --}}
</main>
@endsection
@section('script')
@parent
@endsection