<x-layout>
    <div class="border border-dashed border-slate-400 m-4 p-2">
        <div class="border border-dashed border-slate-400 m-2 p-2">
            <h3>Carrito</h3>
        </div>

        <div class="border border-dashed border-slate-400 m-2 p-2">
            <a class="text-blue-600 underline" href="{{ route('welcome') }}">Volver</a>
        </div>

        <div class="border border-dashed border-slate-400 m-2 p-2">
            <ul>
                @forelse ($cartItems as $item)
                <li class="flex border border-dashed m-2 p-2 gap-2 items-center">
                    <div>
                        @if (isset($item['product']['images'][0]['original_url']))
                        <img class="border border-slate-400 shadow rounded"
                            src="{{ $item['product']['images'][0]['original_url'] }}" alt="Imagen" height="50"
                            width="50">
                        @else
                        <img src="{{ asset('images/product_placeholder.png') }}" alt="Imagen" height="50" width="50">
                        @endif
                    </div>

                    <div class="w-1/2">
                        {{ $item['product']['name'] }}
                    </div>

                    <div class="flex">
                        <button class="px-2 border border-solid rounded bg-blue-400 text-white">-</button>
                        <div class="px-4">{{ $item['quantity'] }}</div>
                        <button class="px-2 border border-solid rounded bg-blue-400 text-white">+</button>
                    </div>

                    <div>
                        $ {{ number_format($item['product']['price'], 2) }}
                    </div>
                </li>
                @empty
                <li>No hay items en el carrito todavía.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layout>
