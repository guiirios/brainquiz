  <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>{{ config('app.name', 'Turma 90') }}</title>
     {{-- CSS --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     {{-- CSS --}}
 </head>
 <body>
     <div class="container">
    <h1>Cod.: {{ $lista->id_lista }} - {{ $lista->nome }}</h1>
    <p>
        Status:
        @if($lista->status == 0) 
            EM ABERTO
        @else 
            FINALIZADA
        @endif
        - Usuário: 
        {{ $lista->usuario->name }}
    </p>  

    {{-- TABELA --}}
    <div class="row mt-4">
        <h1>Relação de Produtos</h1>
        <table class="table table-striped table-hover table-bordered">
            <thead>                
                <th>Status</th>
                <th>Produto</th>
                <th>Atualizado</th>
            </thead>
            <tbody>
                @foreach ($lista->produtos()->get() as $item)
                    <tr>
                        <td>{!! $item->iconeStatus() !!}</td>
                        <td>{{ $item->produto->produto }}</td>
                        <td>{!! $item->updated_at->format('d/m/Y \a\s H:i') !!}h</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- /TABELA --}}
</div>    
</body>
{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
{{-- /JS --}}
</html>


