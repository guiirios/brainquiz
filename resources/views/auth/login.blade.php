<x-guest-layout>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
            
            <img src="./img/rocket.png" alt="rocket" class="rocket">
            <div class="text">
                <h1>LOGIN</h1>
                <p>PÁGINA DE LOGIN</p>
            </div>

            {{-- LOGIN --}}
            <form  class="form" method="POST" action="{{ route('login') }}" >
                    @csrf
                    <!-- Email -->
                    
                    <div class="animated-input">
                        <label for="email" :value="__('Email')">
                        <input type="email" placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
                    </div>
                
                    <!-- Senha -->
                    <div class="animated-input">
                        <label for="password" :value="__('Senha')">
                        <input placeholder="Senha" id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 required autocomplete="current-password" />
                    </div>
            
                <!-- Lembrar-me -->
                    <div class="check ">
                        <div>
                            <input type="checkbox" id="check">
                            <label for="check" class="disc"></label>
                            <label for="check" class="remember">Lembrar-me</label>
                        </div>
                    </div>
                <!-- Lembrar-me -->

            <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                        <button class="btn" type="submit">LOGIN</button>
                        <p class="account"><a href="#">Criar Conta ?</a></p>
                        </div>
            </form>
            {{-- LOGIN --}}

            {{-- Já registrado --}}
            <div>
                
            <p class="forget"><a href="{{ route('register') }}">Registrar-se</a></p>
            </div>
            
            {{-- Já registrado --}}
            
               
       
            
    <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    
</body>
</html>
</x-guest-layout>
