<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="container" class="p-4">
        <div id="results" class="border border-dashed border-slate-400 m-4 p-2">
            <div class="border border-dashed border-slate-400 m-2 p-2">
                <h3>Listado de productos</h3>
            </div>

            <div class="border border-dashed border-slate-400 m-2 p-2">
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

                    <div class="flex-1 p-4 border border-slate-400 shadow-2xl rounded max-w-1/6">
                        <div class="flex-col space-y-2">
                            <span class="border rounded border-blue-300 text-blue-700 bg-blue-100 px-2 text-sm">{{
                                $product['product_type_name']}}
                            </span>

                            <div class="mt-2 text-2xl font-bold">{{ $product['name'] }}</div>

                            <div class="text-sm font-semibold">{{ $product['brand_name'] }}</div>

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

                            <div class="text-slate-600 text-sm">{{ $product['description'] }}</div>

                            <div class="mt-2 flex justify-end">ARS {{ number_format($product['price'],2) }}</div>
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
            </div>
        </div>
    </div>
</body>

</html>
