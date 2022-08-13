<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BrainQuiz</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  {{-- CSS --}}

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- CSS --}}
</head>

<body>
  <nav>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="./img/rosto.png" alt="">
          <div class="admin-info">
            <h3>{{ Auth::user()->name }}</h3>
          </div>
        </div>
      </div>
      <div class="search">
        <i class='bx bx-search'></i>

        <form method="POST" action="{{route('quiz.pesquisa')}}">
          @csrf    
          <input type="search" class="hide" placeholder="Pesquise um quiz" name="pesquisa">
        </form>
              
      </div>
    </div>
    <div class="sidebar-links">
      <ul>

        <li class="tooltip-element" data-tooltip="0">
          <a href=" {{ route('quiz.index') }} " class="active" data-active="0">
            <div class="icon">
              <i class='bx bx-home'></i>
              <i class='bx bxs-home'></i>
            </div>
            <span class="link hide">Início</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="1">
          <a href="{{ route ('categoria.index') }}" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Categorias</span>
          </a>
        </li>

        @if(Auth::user()->id == 1)
        <li class="tooltip-element" data-tooltip="3">
          <a href="{{ route('categoria.create') }}" data-active="3">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Criar Categorias</span>
          </a>
        </li>
        @endif

        <li class="tooltip-element" data-tooltip="2">
          <a href="{{ route ('quiz.create')}}" data-active="2">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">Criar Seu Quiz</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="0">
          <a href="{{ route('quiz.rank') }}" data-active="4">
            
            <style>
              .dir  {
                margin-left: 20px
              }
            </style>
            <span class="link hide fs-6 dir"><i class="bi bi-gem"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rank</span>
          </a>
        </li>

        {{-- <li class="tooltip-element" data-tooltip="1">
          <a href="#" data-active="5">
            <div class="icon">
              <i class='bx bx-help-circle'></i>
              <i class='bx bxs-help-circle'></i>
            </div>
            <span class="link hide">Help</span>
          </a>
        </li>

        <li class="tooltip-element" data-tooltip="2">
          <a href="#" data-active="6">
            <div class="icon">
              <i class='bx bx-cog'></i>
              <i class='bx bxs-cog'></i>
            </div>
            <span class="link hide">Settings</span> --}}
          </a>
        </li>

      </ul>
      
    </div>
    <a href="{{ route('sair') }}" class="log-out">
      <i class='bx bx-log-out'></i>
    </a>
    @yield('menu')
  </nav>

{{-- conteudo --}}
@yield('conteudo')
{{-- conteudo --}}
  
  <script src="app.js"></script>
</body>
{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('script')
{{-- /JS --}}
</html>