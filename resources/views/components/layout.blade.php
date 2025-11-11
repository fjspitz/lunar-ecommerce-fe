<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend</title>
    <link rel="icon" href="{{ asset('images/circulo_verde.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>

<body>
    <nav id="navbar" class="bg-blue-200 py-4 px-8">
        <div class="flex justify-between items-center">
            <div>
                <img src="{{ asset('images/logoipsum-404.svg') }}" alt="Logo">
            </div>
            <div class="flex justify-around gap-2">
                <div class="text-blue-700">
                    @auth
                    <p>Bienvenido {{ Auth::user()->name }}</p>
                    @endauth

                    @guest
                    <a href="{{ route('login')}}#" class="text-blue-700 underline">Login</a>
                    @endguest
                </div>
                <div>
                    <a href="{{ route('cart.index') }}" class="text-blue-600" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div id="container" class="mx-32">
        <div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
