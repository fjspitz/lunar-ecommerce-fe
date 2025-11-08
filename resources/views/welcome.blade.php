<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend</title>
    <link rel="icon" href="{{ asset('images/circulo_verde.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        /* Estilos básicos para el diálogo */
        #cart-dialog {
            padding: 2rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Estiliza el fondo (backdrop) cuando el diálogo está abierto */
        #cart-dialog::backdrop {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            /* Efecto opcional de desenfoque */
        }
    </style>
</head>

<body>
    <div id="container" class="p-4 mx-32">
        <div id="navbar">
            <div class="flex justify-between">
                <div>Logo</div>
                <div class="flex justify-around gap-2">
                    <div>
                        @auth
                        <p>Bienvenido {{ Auth::user()->name }}</p>
                        @endauth

                        @guest
                        <a href="{{ route('login')}}#" class="text-blue-600 underline">Login</a>
                        @endguest
                    </div>
                    <div>
                        <a href="#" class="text-blue-600" id="open-cart-dialog-link">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div id="results" class="border border-dashed border-slate-400 m-4 p-2">
            <div class="border border-dashed border-slate-400 m-2 p-2">
                <h3>Listado de productos</h3>
            </div>

            <div class="border border-dashed border-slate-400 m-2 p-4 bg-slate-100">
                @if(isset($products))
                <ul class="flex flex-wrap items-stretch gap-4">
                    @forelse ($products as $product)
                    {{-- <li>
                        <div>
                            {{ $product['name'] }} | {{ $product['product_type_name'] }} | {{ $product['brand_name'] }}
                            | ARS {{ $product['price'] }} | {{ $product['description'] }}
                        </div>
                    </li>
                    @empty
                    <li>
                        No se han encontrado productos aún.
                    </li> --}}

                    <div class="flex-1 p-4 border border-slate-400 shadow-2xl rounded max-w-1/6 bg-white">
                        <div class="flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <span
                                    class="border rounded border-blue-300 text-blue-700 bg-blue-100 px-2 py-1 text-xs">{{
                                    $product['product_type_name']}}
                                </span>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>

                            </div>

                            <div class="text-sm font-semibold text-gray-400">{{ $product['brand_name'] }}</div>

                            <div class="mt-2 text-lg font-bold">{{ $product['name'] }}</div>

                            <div class="text-sm font-semibold text-gray-500">{{ $product['owner'] }}</div>

                            @if (isset($product['images'][0]['original_url']))
                            <div class="flex justify-center">
                                <img class="border border-slate-400 shadow rounded"
                                    src="{{ $product['images'][0]['original_url'] }}" alt="Imagen" height="200"
                                    width="200">
                            </div>
                            @else
                            <div class="flex justify-center">
                                <img src="{{ asset('images/product_placeholder.png') }}" alt="Imagen" height="200"
                                    width="200">
                            </div>
                            @endif

                            <div class="text-slate-600 text-xs">
                                {{ Illuminate\Support\Str::limit($product['description'], 120) }}
                            </div>

                            <div class="mt-2 flex justify-end">ARS {{ number_format($product['price'],2) }}</div>

                            <div>
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <input type="submit" value="Comprar ahora"
                                        class="border rounded-md bg-blue-500 text-white font-bold px-4 py-2 hover:cursor-pointer">
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div>
                        No se han encontrado productos aún.
                    </div>
                    @endforelse
                </ul>
                @else
                <ul>
                    <li>No se han encontrado productos aún.</li>
                </ul>
                @endif
            </div>
        </div>

        <div id="search" class="border border-dashed border-slate-400 m-4 p-2">
            <div class="border border-dashed border-slate-400 m-2 p-2">
                <form action="{{ route('search.name') }}">
                    @csrf
                    <input id="name" type="text" name="name" placeholder="Buscar producto por texto libre"
                        class="py-1 px-2 border border-slate-600 rounded-sm">
                    <input type="submit" value="Buscar"
                        class="py-1 px-2 border border-slate-600 rounded-sm bg-slate-700 text-white">
                </form>
            </div>

            <div class="flex">
                <div class="grow border border-dashed border-slate-400 m-2 p-2">
                    <div id="categories" class="">
                        <h4 class="font-semibold">Buscar por categoría</h4>
                        <ul>
                            @foreach ($categories as $category)
                            <li>
                                <a class="text-sm text-blue-700 hover:font-semibold"
                                    href="{{ route('search.category', [ 'category_id' => $category['id'] ]) }}">{{
                                    $category['name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="grow border border-dashed border-slate-400 m-2 p-2">
                    <div id="brands">
                        <h4 class="font-semibold">Buscar por marca</h4>
                        <ul>
                            @foreach ($brands as $brand)
                            <li>
                                <a class="text-sm text-blue-700 hover:font-semibold"
                                    href="{{ route('search.brand', [ 'brand_id' => $brand['id'] ]) }}">{{ $brand['name']
                                    }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="grow border border-dashed border-slate-400 m-2 p-2">
                    <div id="collections">
                        <h4 class="font-semibold">Buscar por collección</h4>
                        <ul>
                            @forelse ($collections as $collection)
                            <li>
                                <a class="text-sm text-blue-700 hover:font-semibold" href="#">{{ $brand['name'] }}</a>
                            </li>
                            @empty
                            <li class="text-sm">
                                No hay colecciones definidas aún.
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="grow border border-dashed border-slate-400 m-2 p-2">
                    <div id="stores">
                        <h4 class="font-semibold">Buscar por tienda</h4>
                        <ul>
                            @forelse ($stores as $store)
                            <li>
                                <a class="text-sm text-blue-700 hover:font-semibold" href="#">{{ $store['name'] }}</a>
                            </li>
                            @empty
                            <li class="text-sm">
                                No hay tiendas definidas aún.
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="cart-dialog">
        ## 🛍️ Tu Carrito de Compras

        <ul>
            @forelse ($cartItems as $item)
            <li>{{ $item->name }} - ${{ number_format($item->price, 2) }}</li>
            @empty
            <li>Tu carrito está vacío.</li>
            @endforelse
        </ul>

        {{-- <p>Total: ${{ number_format($cartTotal, 2) }}</p> --}}

        <button id="close-cart-dialog-button">Cerrar</button>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Obtener los elementos
            const dialog = document.getElementById('cart-dialog');
            const openLink = document.getElementById('open-cart-dialog-link');
            const closeButton = document.getElementById('close-cart-dialog-button');

            // **IMPORTANTE:** Verificar si el navegador soporta <dialog>
            if (!dialog.showModal) {
                console.error("Tu navegador no soporta el elemento <dialog> nativo.");
                // Podrías agregar un fallback aquí, como abrir un div modal clásico
            }
            
            // 2. Abrir el diálogo cuando se hace clic en el enlace
            openLink.addEventListener('click', function(e) {
                e.preventDefault(); // Previene el comportamiento predeterminado del enlace (#)
                dialog.showModal(); // Muestra el diálogo de forma modal
            });

            // 3. Cerrar el diálogo cuando se hace clic en el botón de cerrar
            closeButton.addEventListener('click', function() {
                dialog.close(); // Cierra el diálogo
            });
            
            // **Opcional:** Cierre al hacer clic en el backdrop (el área gris fuera del diálogo)
            dialog.addEventListener('click', function(event) {
                // Verifica si el clic ocurrió *directamente* en el elemento <dialog> (el backdrop)
                if (event.target === dialog) {
                    dialog.close();
                }
            });
        });
    </script>
</body>

</html>
