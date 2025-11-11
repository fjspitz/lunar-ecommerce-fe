<x-layout>
    <div id="results" class="border border-dashed border-slate-400 m-4 p-2">
        {{-- <div class="border border-dashed border-slate-400 m-2 p-2">
            <h3>Listado de productos</h3>
        </div> --}}

        <div class="border border-dashed border-slate-400 m-2 p-4 bg-slate-100">
            @if(isset($products))
            <ul class="flex flex-wrap items-stretch gap-4">
                @forelse ($products as $product)
                <div class="flex-1 p-4 border border-slate-400 shadow-2xl rounded max-w-1/6 bg-white">
                    <div class="flex-col space-y-2 content-between">
                        <div class="flex justify-between items-center">
                            <span class="border rounded border-blue-300 text-blue-700 bg-blue-100 px-2 py-1 text-xs">{{
                                $product['product_type_name']}}
                            </span>

                            <div class="favorite text-red-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="text-sm font-semibold text-gray-400">{{ $product['brand_name'] }}</div>

                        <div class="mt-2 text-md font-bold">{{ $product['name'] }}</div>

                        <div class="text-sm font-semibold text-gray-500">{{ $product['owner'] }}</div>

                        @if (isset($product['images'][0]['original_url']))
                        <div class="flex justify-center">
                            <img class="border border-slate-400 shadow rounded"
                                src="{{ $product['images'][0]['original_url'] }}" alt="Imagen" height="200" width="200">
                        </div>
                        @else
                        <div class="flex justify-center">
                            <img src="{{ asset('images/product_placeholder.png') }}" alt="Imagen" height="200"
                                width="200">
                        </div>
                        @endif

                        <div class="text-slate-600 text-xs">
                            {{ Illuminate\Support\Str::limit($product['description'], 120) }} <span><a href="#"
                                    class="text-blue-600">Ver más</a></span>
                        </div>

                        <div class="mt-2 flex justify-end">ARS {{ number_format($product['price'],2) }}</div>
                    </div>
                    <div class="">
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="submit" value="Comprar ahora"
                                class="border rounded-md bg-blue-500 text-white text-sm font-bold px-4 py-2 hover:cursor-pointer">
                        </form>
                    </div>
                </div>
                @empty
                <div>
                    No se han encontrado productos aún.
                </div>
                @endforelse
            </ul>
            @else
            <div class="min-h-32">
                <p>No se han encontrado productos todavía.</p>
            </div>
            @endif
        </div>
    </div>

    <div id="search" class="border border-dashed border-slate-400 m-4 p-2">
        <div class="border border-dashed border-slate-400 m-2 p-2">
            <form action="{{ route('search') }}" method="GET">
                @csrf
                <input type="hidden" name="criteria" value="by_name">

                <input id="name" type="text" name="value" placeholder="Buscar producto por texto libre"
                    class="py-1 px-2 border border-slate-300 rounded-sm text-sm min-w-1/3">

                <input type="submit" value="Buscar"
                    class="py-1 px-2 border border-slate-600 rounded-sm bg-slate-700 text-white text-sm">
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
                                href="{{ route('search', [ 'criteria' => 'by_category', 'value' => $category['id'] ]) }}">{{
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
                                href="{{ route('search', [ 'criteria' => 'by_brand', 'value' => $brand['id'] ]) }}">{{
                                $brand['name']
                                }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="grow border border-dashed border-slate-400 m-2 p-2">
                <div id="collections">
                    <h4 class="font-semibold">Buscar por colección</h4>
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
</x-layout>
