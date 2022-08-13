<x-guest-layout>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <div class="container">
        
       
            <img src="./img/rocket.png" alt="rocket" class="rocket">
            <div class="text">
                <h1>REGISTRO</h1>
            </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        

        {{-- REGISTRAR --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="animated-input">    
            <div>
                <label for="name" :value="__('Name')">
                <input placeholder="Nome" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
        </div>   
                                               
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

            <!-- Confirm Password -->
            <div class="animated-input">
                <label for="password_confirmation" :value="__('Confirm Password')">
                <input placeholder="Confirme à Senha" id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation"
                         required autocomplete="current-password" required />
            </div>
            <br>
        
                <x-button class="ml-4">
                    <button class="btn" type="submit">Cadastrar-se</button>
                </x-button>

            <br>
            <br>
                {{-- Ja tem uma conta --}}
                <div>
                <p class="forget"><a href="{{ route('login') }}">Já possui uma conta?</a></p>
                </div>
                {{-- Ja tem uma conta --}}
            </div>
        </form>
    </body>
</html>
</x-guest-layout>